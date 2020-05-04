<?php

namespace App\Http\Controllers\API;

use App\Banner;
use App\Firm;
use App\Upload;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Support\Facades\DB;

class FirmController extends Controller
{
    private $photos_path;


    public function __construct()
    {
        $this->photos_path = public_path('/upload');
    }
    // получение координат для вывода на карте
    public function index()
    {
        $firms = Firm::where('status', 1)->select('id', 'title', 'address', 'location')->get();
        $res = [];
        foreach ($firms as $k => $firm) {
            $lat = $firm->location->getLat();
            $lng = $firm->location->getLng();
            $coord = $lat . "_" . $lng;
            if (isset($res[$coord])) {
                $res[$coord][] = [
                    "id" => $firm->id,
                    "title" => $firm->title,
                    "address" => $firm->address,
                ];
            } else {
                $res[$coord] = [];
                $res[$coord][] = [
                    "id" => $firm->id,
                    "title" => $firm->title,
                    "address" => $firm->address,
                    "coord"=>['lat' => $lat, "lng" => $lng]
                ];
            }
        }
        $banner_home=Banner::select('photobig','photosmall','link','description')->find(1);
        $banner_top=Banner::select('photobig','photosmall','link','description')->find(2);
        $banner_bottom=Banner::select('photobig','photosmall','link','description')->find(3);

        return response()->json([
            'firms' => $res,
            'banner_home'=>$banner_home,
            'banner_bottom'=>$banner_bottom,
            'banner_top'=>$banner_top,
        ]);

    }
    // получение одиночной фирмы
    public function getFirm(Request $request)
    {
        $id = $request->id;
        try {

            $firm = Firm::select('id', 'title','basic', 'address', 'category_id', 'time_work', 'service', 'email', 'phone', 'meta_title', 'meta_description', 'location', 'photos','status')->findOrFail($id);
             if($firm->status===0){
                 return response()->json(['error' => trans('validation.notFirm')], 404);
             }

            $firm->photos = $firm->allphotos;
            $firm->rating=intval($firm->ratingsAvg());
            $lat = $firm->location->getLat();
            $lng = $firm->location->getLng();

            $coord = $lat . "_" . $lng;
            $firm->coord=$coord;
            $firm->lat_lng=['lat'=>$lat,'lng'=>$lng];
            // показать ли режим работы в категории
            $firm->timeworkstatus=$firm->category->timeworkstatus;

            $firm->others = DB::select("SELECT id,title,basic FROM firms WHERE st_distance_sphere(location, POINT('$lng',$lat)) <= 100 AND id!=".$id." AND status=1 ORDER BY id DESC");

            // определяем базовый объект ************************
            if((int)$firm->basic===0&&count($firm->others)>0){
                $ids=[$firm->id];
                $others_basic=false;
                $basic_id=false;
                foreach ($firm->others as $other){
                    if((int)$other->basic==1){
                        $others_basic=true;
                        $basic_id=(int)$other->id;
                        break;
                    }else{
                        $ids[]=(int)$other->id;
                    }
                }

                if(!$others_basic){
                    $min_id=min($ids);
                    $basic_id=$min_id;
                    // если
                    if((int)$firm->id==$min_id){
                        $firm->basic=1;
                    }else{
                        foreach ($firm->others as $key=>$other){
                            if((int)$other->id==$min_id){
                                $other->basic=1;
                                break;
                            }
                        }
                    }
                }

                $firm->basic_id=$basic_id;
            }
            // определяем базовый объект end ********************
            return response()->json(
                [
                    'firm' => $firm,
                ]);

        } catch (ModelNotFoundException $ex) {
            return response()->json(['error' => trans('validation.notFirm')], 404);
        }
    }

    // добавление фирмы
    public function store(Request $request)
    {

        $firm = new Firm;
        $firm_req = $request->firm;

        $firm->title = $firm_req['title'];
        $firm->service = $firm_req['service'];
        $firm->category_id = $firm_req['category_id'];
        $firm->phone = $firm_req['phone'];
        $firm->email = $firm_req['email'];
        $firm->site = $firm_req['site'];

        $firm->time_work = $firm_req['time_work'];

        $firm->comment = $firm_req['comment'];

        $firm->address = $request->address;
        $firm->location = new Point($request->location['lat'], $request->location['lng']);
        $firm->user_id = $request->user_id;
        $photos = $firm_req['photos'];

        if (!empty($photos)) {
            $photo_sql = [];
            foreach ($photos as $photo) {
                $uploaded_image = Upload::where('original_name', $photo)->latest('id')->first();
                $file_path = $this->photos_path . '/' . $uploaded_image->filename;
                if (file_exists($file_path)) {
                    $photo_sql[] = 'upload/' . $uploaded_image->filename;
                } else {
                    //если нет изображения то удаляем
                    $uploaded_image->delete();
                }

            }
            if (!empty($photo_sql)) {
                $firm->photos = $photo_sql;
            }

        }
        $firm->save();
        return response()->json(['succes' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }


    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function saveTimeWork(Request $request){
        $id=$request->id;
        $res=$request->res;
        $firm = Firm::find( $id);
        $firm->time_work = $res;
        $firm->save();
        return response()->json(['suc'=>true]);
    }

    public function getCategories(){
        $categories=Category::select('title_en','title_uk','title_ru','id','timeworkstatus')->where('published',1)->get()->toArray();
        return response()->json(['categories'=>$categories]);
    }

}

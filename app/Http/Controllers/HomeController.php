<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Firm;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }


    public function index(Request $request)
    {

        return view('home');
    }

    public function test()
    {

        $id=2;

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

        $firm->others = DB::select("SELECT id,title,basic FROM firms WHERE st_distance_sphere(location, POINT('$lng',$lat)) <= 100 AND id!=".$id." AND status=1 ORDER BY id DESC");




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

        dump($firm->others);



        /*
        $random=Str::random();
        $locales=config('app.locales');
        foreach ($locales as $key=>$locale){
            $category_loc=new \App\CategoryTranslation;
            $category_loc->language=$key;
            $category_loc->category_id=$category->id;
            $category_loc->title=$random."_".$key;
            $category_loc->save();
        }
        */

        /*
        $KEY=env('YANDEX_KEY');

        $api = new \Yandex\Geo\Api($KEY);
        $api->setQuery('Тверская 6');
        $api
            ->setLimit(1) // кол-во результатов
            ->setLang(\Yandex\Geo\Api::LANG_US) // локаль ответа
            ->load();

        $response = $api->getResponse();
        $response->getFoundCount(); // кол-во найденных адресов
        $response->getQuery(); // исходный запрос
        $response->getLatitude(); // широта для исходного запроса
        $response->getLongitude(); // долгота для исходного запроса

        $collection = $response->getList();
        dump($collection);
        dd();
        foreach ($collection as $item) {
            $item->getAddress(); // вернет адрес
            $item->getLatitude(); // широта
            $item->getLongitude(); // долгота
            $item->getData(); // необработанные данные
        }
        */
    }
}


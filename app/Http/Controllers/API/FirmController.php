<?php

namespace App\Http\Controllers\API;

use App\Firm;
use App\Upload;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class FirmController extends Controller
{
    private $photos_path;


    public function __construct()
    {
        $this->photos_path = public_path('/upload');
    }
    public function index()
    {
        $firms = Firm::where('status', 1)->select('id', 'title', 'address', 'location')->get()->toArray();
        foreach ($firms as $k => $firm) {
            $firms[$k]['latlng'] = ['lat' => $firm['location']->getLat(), "lng" => $firm['location']->getLng()];
        }
        return response()->json(['firms' => $firms]);
    }
    // получение одиночной фирмы
    public function getFirm(Request $request)
    {
        $id = $request->id;
        try {
            // $firm_type=config('firm_type');
            $firm = Firm::select('id', 'title', 'address', 'type', 'time_work', 'service', 'email', 'phone', 'meta_title', 'meta_description', 'location', 'photos')->findOrFail($id);
            $photos = $firm->photos;
            $photos_res = [];
            if (!empty($photos)) {
                $url = config('app.url');
                foreach ($photos as $photo) {
                    $photo_name = str_replace('upload/', '', $photo);
                    $resized_name = Upload::where('filename', $photo_name)->first();
                    if ($resized_name) {
                        $resized_res = $url . '/upload/' . $resized_name->resized_name;
                    } else {
                        $resized_res = $url . '/' . $photo;
                    }
                    $photos_res[] = ['photo' => $url . '/' . $photo, 'resized' => $resized_res];
                }

            }
            $firm->photos = $photos_res;
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
        $firm->type = $firm_req['type'];
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
}

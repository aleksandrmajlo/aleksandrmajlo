<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Firm;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $firms = [];
        $LatLng = false;
        if ($request->has('title')) {
            $ob = self::serchTitleName($request->title);
            $firms = $ob['firms'];
            $LatLng=$ob['LatLng'];
        } elseif ($request->has('q')) {
            if (!empty($request->q)) {
                $firms = self::serchByQueryAddress($request->q);
            }
        }
        if (empty($firms)) {
            $firms = [];
        }
        return response()->json([
            'firms' => $firms,
            'latlng' => $LatLng
        ]);

    }
    static function serchTitleName($title)
    {
//        try {

        /*
        $distance = 1;
        $firms = [];
        if ($city) {
            $distance = 1000;
            $firms = Firm::where('status', 1)
                ->where(function ($query) use ($city) {
                    $query->where('address', 'like', '%' . $city . '%');
                })
                ->select('id', 'title')
                ->get()->toArray();
        }

        $coord = explode('_', $coord_q);
        $lat = floatval($coord[0]);
        $lng = floatval($coord[1]);
        $res = DB::select("SELECT id,title FROM firms WHERE st_distance_sphere(location, POINT('$lng',$lat)) <= " . $distance);
        $result_return = [];
        if (!empty($firms)) {
            foreach ($firms as $firm) {
                $result_return[] = [
                    'id' => $firm['id'],
                    'title' => $firm['title'],
                ];
            }
        }
        if (!empty($res)) {
            foreach ($res as $key => $re) {
                $result_return[] = [
                    'id' => $re->id,
                    'title' => $re->title,
                ];
            }
        }
        $result_return = array_unique($result_return, SORT_REGULAR);
        return $result_return;
        */
        $firms = Firm::where('status', 1)
            ->where(function ($query) use ($title) {
                $query->where('title', 'like', '%' . $title . '%')
                    ->orWhere('address_uk', 'like', '%' . $title . '%')
                    ->orWhere('address_ru', 'like', '%' . $title . '%')
                    ->orWhere('address_en', 'like', '%' . $title . '%')
                    ->orWhere('address', 'like', '%' . $title . '%');
            })
            ->select('id', 'title', 'address','location')
            ->get()->toArray();
        $LatLng = false;
        try {

            $address = $title;
            $KEY = env('YANDEX_KEY');
            $locale = \App::getLocale();
            if ($locale == "uk") {
                $lang = 'uk-UA';
            } elseif ($locale == 'en') {
                $lang = 'en-US';
            } else {
                $lang = 'ru-RU';
            }
            $api = new \Yandex\Geo\Api($KEY);
            $api->setQuery($address);
            $api
                ->setLimit(1) // кол-во результатов
                ->setLang($locale) // локаль ответа
                ->load();
            $response = $api->getResponse();
            if ($response) {
                $collection = $response->getList();
                if(!empty($collection)){
                    $result = $collection[0];
                    $LatLng = [
                        'lat' => $result->getLatitude(),
                        'lng' => $result->getLongitude()
                    ];
                }
            }
        } catch (Exception $e) {

        }
        return [
            'firms' => $firms,
            'LatLng' => $LatLng
        ];
    }

    static function serchByQueryAddress($q)
    {
        $local=\App::getLocale();
        $firms = Firm::where('status', 1)
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', '%' . $q . '%')
                    ->orWhere('address_uk', 'like', '%' . $q . '%')
                    ->orWhere('address_ru', 'like', '%' . $q . '%')
                    ->orWhere('address_en', 'like', '%' . $q . '%')
                    ->orWhere('address', 'like', '%' . $q . '%');
            })
            ->select('id', 'title', 'address','address_'.$local,'location')
            ->get()->toArray();
        return $firms;
    }
}

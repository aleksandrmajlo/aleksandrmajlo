<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class YandexgeoController extends Controller
{
    public function getLatLng(Request $request)
    {

        ini_set( 'precision', 17 );
        ini_set( 'serialize_precision', 17 );
        //*************************************
        $address = $request->address;
        $KEY = env('YANDEX_KEY');
        $LatLng = false;
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
                    'lat' => (string)$result->getLatitude(),
                    'lng' => (string)$result->getLongitude()
                ];
            }
        }
        return response()->json(['latlng' => $LatLng]);
    }
}

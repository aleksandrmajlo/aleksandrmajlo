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
        $firms = null;
        if ($request->has('coord')) {
            $city = false;
            if ($request->has('city')) {
                $city = $request->city;
            }
            $firms = self::serchCoord($request->coord, $city);
        } elseif ($request->has('q')) {
            if (!empty($request->q)) {
                $firms = self::serchByTitleAddress($request->q);
            }
        }
        if (empty($firms)) {
            $firms = null;
        }
        return response()->json(['firms' => $firms]);

    }

    static function serchCoord($coord_q, $city)
    {

        try {

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
        } catch (Exception $e) {

        }

    }

    static function serchByTitleAddress($q)
    {

        /*
        $res_geo = [];
        // на один день
        $appId = "plNE57FG36HY";
        $apiKey = "4ca625b39b5b1e2f8c4282d51de2135a";
        //100 0000
//        $appId = "plGI4WX834ON";
//        $apiKey = "c6b248d20b8626e86fa7785893a9160c";
        $ld = new \LanguageDetection\Language;
        $object = $ld->detect($q)->__toString();

        $places = \Algolia\AlgoliaSearch\PlacesClient::create(
            $appId,
            $apiKey
        );
        $results = $places->search($q);
        if (!empty($results['hits'])) {
            foreach ($results['hits'] as $result) {
                if ($result["is_city"]) {
                    $country = $result["country"]["default"];
                    if (isset($result["country"][$locale])) {
                        $country = $result["country"][$locale];
                    }
                    $city = $result["locale_names"]["default"][0];
                    if (isset($result["locale_names"][$locale])) {
                        $city = $result["locale_names"][$locale];
                    }
                    $pos = strpos($city, $q);
                    if ($pos === false) {
                        continue;
                    }
                    $res_geo[] = [
                        'title' => $city,
                        "country" => $country,
                        'geoloc' => $result["_geoloc"]['lat'] . '_' . $result["_geoloc"]['lng'],
                        'type' => "geoloc"
                    ];
                }
            }
        }
        */
        $firms = Firm::where('status', 1)
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', '%' . $q . '%')
                    ->orWhere('address', 'like', '%' . $q . '%');
            })
            ->select('id', 'title', 'address')
            ->get()->toArray();
        /*
        $res_global = array_merge($res_geo, $firms);
        usort($res_global, function ($item1, $item2) {
            return $item1['title'] <=> $item2['title'];
        });
        */

        return $firms;
    }
}

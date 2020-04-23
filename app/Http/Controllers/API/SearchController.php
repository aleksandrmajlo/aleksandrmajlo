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
        $firms = Firm::where('status', 1)
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', '%' . $q . '%')
                    ->orWhere('address', 'like', '%' . $q . '%');
            })
            ->select('id', 'title', 'address')
            ->get()->toArray();
        return $firms;
    }
}

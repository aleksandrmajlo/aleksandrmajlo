<?php

namespace App\Http\Controllers;

use App\Firm;
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
//        *****************************************************
        /*
        $id=5;
        $firm = Firm::select('id', 'title', 'address', 'type', 'time_work', 'service', 'email', 'phone', 'meta_title', 'meta_description', 'location', 'photos','status')->findOrFail($id);
        if($firm->status===0){
            return response()->json(['error' => trans('validation.notFirm')], 404);
        }
        $firm->photos = $firm->allphotos;
        $firm->rating=intval($firm->ratingsAvg());
        $lat = $firm->location->getLat();
        $lng = $firm->location->getLng();
        $coord = $lat . "_" . $lng;
        $firm->coord=$coord;
        $others = DB::select("SELECT id,title FROM firms WHERE st_distance_sphere(location, POINT('$lng',$lat)) <= 100 AND id!=".$id." ORDER BY id DESC");
        dump($others);
        dd();

        return response()->json(
            [
                'firm' => $firm,
            ]);
        */
//        *****************************************************

        return view('home');
    }
}

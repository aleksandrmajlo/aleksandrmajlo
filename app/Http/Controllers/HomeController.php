<?php

namespace App\Http\Controllers;

use App\Firm;
use Illuminate\Http\Request;

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
                ];
            }
        }
        dump($res);
        */
//        *****************************************************

        return view('home');
    }
}

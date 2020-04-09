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

//        $position = \Location::get(request()->ip());
        return view('home');
    }
}

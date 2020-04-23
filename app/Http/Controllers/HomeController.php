<?php

namespace App\Http\Controllers;

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
//        *****************************************************
       /*
        $id = $request->id;
        $user = User::find(1);
        $reviewRes=[];
        if($user->reviews){
            foreach ($user->reviews as $review){
                $reviewRes[]=[
                    'comment'=>$review->comment,
                    'value' =>$review->value,
                    'firm_id'=>$review->firm_id,
                    "firm"=>$review->firm->title
                ];
            }
        }

        dump($reviewRes);
       */
//        *****************************************************

        return view('home');
    }
}

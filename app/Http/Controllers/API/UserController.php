<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Firm;
use App\User;

class UserController extends Controller
{
    public function my_review(Request $request){
        $id=$request->id;
        $user = User::find($id);
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
        return response()->json(['reviews'=>$reviewRes]);
    }
    public function my_firms(Request $request){
        $id=$request->id;
        $user = User::find($id);
        return response()->json(['firms'=>$user->firms]);
    }

    public function  my_favorite(Request $request){
        $ar=$request->all();
        $res=[];
        if($ar&&!empty($ar)){
            foreach ($ar as $item){
                try{
                    $firm = Firm::select('id', 'title')->findOrFail($item);
                    $res[]=[
                        'id'=>$item,
                        'title'=>$firm->title
                    ];
                }
                catch (ModelNotFoundException $ex) {

                }
            }
        }
        return response()->json(['firms'=>$res]);
    }
}

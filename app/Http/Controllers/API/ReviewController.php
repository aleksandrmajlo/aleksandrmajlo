<?php

namespace App\Http\Controllers\API;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Review;
use App\Upload;
use App\User;
use App\Firm;

use Illuminate\Http\Request;

class ReviewController extends Controller
{

    private $photos_path;

    public function __construct()
    {
        $this->photos_path = public_path('/upload');
    }

    public function addReview(Request $request)
    {

        $review = new Review;
        $review->comment = $request->comment;
        $review->value = $request->value;
        $review->user_id = $request->user;
        $review->firm_id = $request->firm_id;
        $review->ip = $request->ip();
        $photos = $request->photos;

        if (!empty($photos)) {
            $photo_sql = [];
            foreach ($photos as $photo) {
                $uploaded_image = Upload::where('original_name', $photo)->latest('id')->first();
                $file_path = $this->photos_path . '/' . $uploaded_image->filename;
                if (file_exists($file_path)) {
                    $photo_sql[] = 'upload/' . $uploaded_image->filename;
                } else {
                    $uploaded_image->delete();
                }
            }
            if (!empty($photo_sql)) {
                $review->photos = $photo_sql;
            }

        }
        $review->save();
        // рейтинг
        $firm = Firm::find($request->firm_id);
        $user = User::find($request->user);
        $user->rate($firm, $request->value);
        return response()->json(['suc' => true]);


    }

    public function getReview(Request $request)
    {
        $id = $request->id;
        try {
            $firm = Firm::findOrFail($request->id);
            $reviews = [
                'firm_id' => (int)$id,
                'reviews' => []
            ];
            if ($firm->reviews) {
                $res = [];
                foreach ($firm->reviews as $review) {
                    $user = $review->user;
                    $res[] = [
                        'id' => $review->id,
                        'comment' => $review->comment,
                        'value' => intval($review->value),
                        'user' => $user->name
                    ];
                }
                $reviews['reviews']=$res;
            }
            return response()->json(['reviews'=>$reviews]);

        } catch (ModelNotFoundException $ex) {
            return response()->json(['error' => trans('validation.notFirm')], 404);
        }

    }
}

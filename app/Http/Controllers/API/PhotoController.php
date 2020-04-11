<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Upload;
use App\User;
use App\Firm;
use App\Photo;

class PhotoController extends Controller
{
    private $photos_path;

    public function __construct()
    {
        $this->photos_path = public_path('/upload');
    }

    public function addPhotos(Request $request)
    {
        $photo_model = new Photo;
        $photo_model->user_id = $request->user;
        $photo_model->firm_id = $request->firm_id;
        $photos = $request->photos;
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
        $photo_model->photos = $photo_sql;
        $photo_model->save();
        return response()->json(['suc' => true]);

    }
}

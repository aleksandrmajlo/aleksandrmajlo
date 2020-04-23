<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Info;
use App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    private $photos_path;

    public function __construct()
    {
        $this->photos_path = public_path('/upload');
    }

    public function send(Request $request)
    {

        $info = new Info;
        $info->email = $request->email;
        $info->messange = $request->messange;
        $info->theme = $request->theme;
        $info->ip = $request->ip();
        $photos = $request->photos;

        $photo_sql = [];
        $file_path_mail = [];
        if (!empty($photos)) {
            foreach ($photos as $photo) {
                $uploaded_image = Upload::where('original_name', $photo)->latest('id')->first();
                $file_path = $this->photos_path . '/' . $uploaded_image->filename;
                if (file_exists($file_path)) {
                    $file_path_mail[] = $this->photos_path . '/' . $uploaded_image->filename;
                    $photo_sql[] = 'upload/' . $uploaded_image->filename;
                } else {
                    $uploaded_image->delete();
                }
            }
            if (!empty($photo_sql)) {
                $info->photos = $photo_sql;
            }
        }
        $info->save();

        $theme = config('info');
        $theme_val = $theme[$request->theme];
        $MAIL_TO_ADMIN = env('MAIL_TO_ADMIN');
        $MAIL_TO_ADMIN_NAME = env('MAIL_TO_ADMIN_NAME');
        $link = env('APP_URL') . '/admin/infos/' . $info->id . '/edit';

        Mail::send('emails.form', [
            'email' => $request->email,
            'messange' => $request->messange,
            'ip' => $request->ip(),
            'link' => $link
        ],
            function ($message) use ($theme_val, $file_path_mail, $MAIL_TO_ADMIN, $MAIL_TO_ADMIN_NAME) {
                $message->to($MAIL_TO_ADMIN, $MAIL_TO_ADMIN_NAME)->subject($theme_val);
                //$message->to('alekslv74@yandex.ua', 'alekslv74')->subject($theme_val);
                if (!empty($file_path_mail)) {
                    foreach ($file_path_mail as $photo) {
                        $message->attach($photo);
                    }
                }
            });


    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Nagy\LaravelRating\Traits\Rate\Rateable;

class Firm extends Model
{
    use Sluggable;
    use SpatialTrait;
    use Rateable;

//    protected $fillable = [
//        'title'
//    ];
    protected $casts = [
//        'time_work' => 'array'
    ];

    protected $spatialFields = [
        'location',
        'area'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function setTimeworkAttribute($value)
    {
        $this->attributes['time_work'] = json_encode($value);
    }

    public function getTimeworkAttribute($value)
    {
        return json_decode($value, true);
    }


    public function setPhotosAttribute($photos)
    {
        if (is_array($photos)) {
            $this->attributes['photos'] = json_encode($photos);
        }
    }

    public function getPhotosAttribute($photos)
    {

        return json_decode($photos, true);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function reviews()
    {
        return $this->hasMany(\App\Review::class)->where('status', 1)->orderByDesc('id');
    }

    public function images()
    {
        return $this->hasMany(\App\Photo::class)->where('status', 1)->orderByDesc('id');
    }

    public function getAllphotosAttribute()
    {
        $photos = $this->photos;
        $result1 = self::ImageSrc($photos);

        $res_img = [];
        $result2 = [];
        if ($this->images) {
            foreach ($this->images as $image) {
                if($image->photos){
                    foreach ($image->photos as $ph) {
                        $res_img[] = $ph;
                    }
                }
            }
            $result2=self::ImageSrc($res_img);
        }

        $res_rew = [];
        $result3 = [];
        if($this->reviews){
            foreach ($this->reviews as $review){
                if($review->photos){
                    foreach ($review->photos as $ph){
                        $res_rew[]=$ph;
                    }
                }
            }
            $result3=self::ImageSrc($res_rew);
        }
        $result=array_merge($result1,$result2,$result3);
        return $result;
    }

    static private function ImageSrc($photos)
    {
        $photos_path = public_path('/upload');
        $url = config('app.url');
        $photos_res = [];
        if (!empty($photos)) {
            foreach ($photos as $photo) {
                $photo_name = str_replace('upload/', '', $photo);
                $resized_name = Upload::where('filename', $photo_name)->first();
                if ($resized_name) {
                    $resized_res = $url . '/upload/' . $resized_name->resized_name;
                } else {
                    $resized_res = $url . '/' . $photo;
                }
                $photos_res[] = ['photo' => $url . '/' . $photo, 'resized' => $resized_res];
            }

        }
        return $photos_res;
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

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

    public function firm()
    {
        return $this->belongsTo(\App\Firm::class);
    }

}

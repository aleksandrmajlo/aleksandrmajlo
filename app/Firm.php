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
}

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Nagy\LaravelRating\Traits\Rate\CanRate;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use CanRate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status'
    ];

    /**
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function firms()
    {
        return $this->hasMany(\App\Firm::class)->where('status', 1)->orderByDesc('id');
    }
    public function reviews()
    {
        return $this->hasMany(\App\Review::class)->where('status', 1)->orderByDesc('id');
    }

}

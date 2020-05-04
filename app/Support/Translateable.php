<?php

namespace App\Support;

use Illuminate\Support\Facades\Config;

trait Translateable
{
    protected static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            $languages = Config::get('app.locales');
            foreach ($languages as $key=>$language) {
                $model->translation()->create(['language' => $key]);
            }
        });
    }
}

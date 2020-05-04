<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
//use App\Support\Translateable;
use App\Firm;
class Category extends Model
{
//    use Translateable;
//    protected $fillable = ['published'];

/*
    public function translation($language = null)
    {
        if ($language == null) {
            $language = App::getLocale();
        }
        return $this->hasMany('App\CategoryTranslation')->where('language', '=', $language);
    }
*/

    public function firms()
    {
        return $this->hasMany(Firm::class);
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class MobileBrand extends Model
{
    use Sluggable;
    protected $fillable = ['brand', 'slug'];

    public function mobile_phones(){
        return $this->hasMany('App\MobilePhone');
    }

    public function mobile_models(){
        return $this->hasMany('App\MobileModel');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'brand'
            ]
        ];
    }
    public function getRouteKeyName(){
        return 'slug';
    }
}

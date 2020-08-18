<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class MobileModel extends Model
{
    use Sluggable;

    protected $fillable = ['model', 'mobile_brand_id', 'slug'];

    public function mobile_brand(){
        return $this->belongsTo('App\MobileBrand');
    }

    public function mobile_phones(){
        return $this->hasMany('App\MobilePhone');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'model'
            ]
        ];
    }
    public function getRouteKeyName(){
        return 'slug';
    }
}

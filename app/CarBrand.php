<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CarBrand extends Model
{
    use Sluggable;
    protected $fillable = ['brand', 'slug'];

    public function car_models(){
        return $this->hasMany('App\CarModel');
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

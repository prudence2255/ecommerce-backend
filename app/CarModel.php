<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CarModel extends Model
{
    use Sluggable;
    protected $fillable = ['model', 'car_brand_id', 'slug'];

    public function car_brands(){
        return $this->belongsTo('App\CarBrand');
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

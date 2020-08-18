<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class MotorBrand extends Model
{
    use Sluggable;
    protected $fillable = ['brand', 'slug'];

    public function motor_models(){
        return $this->hasMany('App\MotorModel');
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

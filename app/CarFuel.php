<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CarFuel extends Model
{
    use Sluggable;
    protected $fillable = ['fuel', 'slug'];


    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'fuel'
            ]
        ];
    }
    public function getRouteKeyName(){
        return 'slug';
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CarTransmission extends Model
{
    use Sluggable;
    protected $fillable = ['transmission', 'slug'];


    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'transmission'
            ]
        ];
    }
    public function getRouteKeyName(){
        return 'slug';
    }
}

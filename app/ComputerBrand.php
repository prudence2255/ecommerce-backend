<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ComputerBrand extends Model
{
    use Sluggable;
    protected $fillable = ['brand', 'slug'];

    // public function computers(){
    //     return $this->hasMany('App\Computer');
    // }

    
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

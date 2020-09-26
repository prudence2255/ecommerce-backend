<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class TvBrand extends Model
{
    use Sluggable;
    protected $fillable = ['brand', 'slug'];

    
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

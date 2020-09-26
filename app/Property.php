<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Property extends Model
{
    use Sluggable;
    protected $fillable = ['type', 'slug'];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'type'
            ]
        ];
    }
    public function getRouteKeyName(){
        return 'slug';
    }
}

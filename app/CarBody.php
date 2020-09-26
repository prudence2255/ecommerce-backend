<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CarBody extends Model
{
    use Sluggable;
    protected $fillable = ['body', 'slug'];

    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'body'
            ]
        ];
    }
    public function getRouteKeyName(){
        return 'slug';
    }
}

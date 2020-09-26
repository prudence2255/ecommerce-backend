<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Gender extends Model
{
    use Sluggable;
    protected $fillable = ['gender', 'slug'];




    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'gender'
            ]
        ];
    }
    public function getRouteKeyName(){
        return 'slug';
    }
}

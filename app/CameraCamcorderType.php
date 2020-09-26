<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CameraCamcorderType extends Model
{
    use Sluggable;
    protected $fillable = ['type', 'slug'];


    
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

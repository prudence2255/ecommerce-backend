<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Location extends Model
{
    use Sluggable;

    protected $fillable = ['name', 'slug', 'parent_id'];

    public function children(){
        return $this->hasMany('App\Location', 'parent_id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function getRouteKeyName(){
        return 'slug';
    }
}

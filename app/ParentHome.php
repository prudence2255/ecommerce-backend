<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ParentHome extends Model
{
    use Sluggable;
    protected $fillable = ['parent', 'slug'];

    public function home_types(){
        return $this->hasMany('App\HomeType');
    }

    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'parent'
            ]
        ];
    }
    public function getRouteKeyName(){
        return 'slug';
    }
}

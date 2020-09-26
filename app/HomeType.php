<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class HomeType extends Model
{
    use Sluggable;
    protected $fillable = ['type', 'parent_home_id','slug'];

    public function parent_homes() {
        return $this->belongsTo('App\ParentHome');
    }

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

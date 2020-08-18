<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class MobileFeature extends Model
{
    use Sluggable;
    protected $fillable = [
        'feature', 'slug'
    ];

    public function mobile_phones(){
        return $this->belongsToMany('App\MobilePhone');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'feature'
            ]
        ];
    }
    public function getRouteKeyName(){
        return 'slug';
    }
}

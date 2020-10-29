<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Http\Traits\OptionTrait;


class Location extends Model
{
    use Sluggable;
    use OptionTrait;
    
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function children(){
        return $this->hasMany('App\Location', 'parent_id');
    }
    public function ads(){
        return $this->hasMany('App\Ad', 'parent_location_id');
    }

    public function adds(){
        return $this->hasMany('App\Ad', 'child_location_id');
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

    public function getNameAttribute($value){
        return $this->name_transform($value);
    }
}

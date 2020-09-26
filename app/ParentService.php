<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ParentService extends Model
{
    use Sluggable;
    protected $fillable = ['parent', 'slug'];

    public function service_types(){
        return $this->hasMany('App\ServiceType');
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

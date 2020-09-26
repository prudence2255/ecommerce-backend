<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ServiceType extends Model
{
    use Sluggable;
    protected $fillable = ['type', 'parent_service_id', 'slug'];

    public function parent_services(){
        return $this->belongsTo('App\ParentService');
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

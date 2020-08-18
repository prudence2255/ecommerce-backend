<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class MotorModel extends Model
{
    use Sluggable;
    protected $fillable = ['model', 'motor_brand_id', 'slug'];

    public function motor_brands(){
        return $this->BelongsTo('App\MotorBrand');
    }

    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'model'
            ]
        ];
    }
    public function getRouteKeyName(){
        return 'slug';
    }
}

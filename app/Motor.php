<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    protected $fillable = [
        'ad_id', 
        'motor_brand_id',
        'motor_model_id',
        'model_year',
        'mileage',
        'edition',
        'engine_capacity',
];


    public function ad(){
    return $this->belongsTo('App\Ad');
}
public function motor_brand(){
    return $this->belongsTo('App\MotorBrand');
}
public function motor_model(){
    return $this->belongsTo('App\MotorModel');
}
}

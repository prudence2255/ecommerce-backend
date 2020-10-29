<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'ad_id', 
        'car_brand_id',
        'car_model_id',
        'model_year',
        'mileage',
        'transmission',
        'fuel_type',
        'engine_capacity',
        'edition'
];


    public function ad(){
    return $this->belongsTo('App\Ad');
}
public function car_brand(){
    return $this->belongsTo('App\CarBrand');
}
public function car_model(){
    return $this->belongsTo('App\CarModel');
}

}

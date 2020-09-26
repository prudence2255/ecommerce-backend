<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    protected $fillable = [
        'ad_id', 'computer_brand_id', 'model', 'device'
    ];
    
    public function ad(){
        return $this->belongsTo('App\Ad');
    }

    public function computer_brand(){
        return $this->belongsTo('App\ComputerBrand');
    }
}

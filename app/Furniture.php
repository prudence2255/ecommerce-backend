<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Furniture extends Model
{
    protected $fillable = [
        'ad_id', 'furniture_type',
];


    public function ad(){
    return $this->belongsTo('App\Ad');
}
}

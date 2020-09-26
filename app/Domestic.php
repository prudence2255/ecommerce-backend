<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domestic extends Model
{
     protected $fillable = [
        'service_type',
        'ad_id',
    ];



public function ad(){
return $this->belongsTo('App\Ad');
}
}

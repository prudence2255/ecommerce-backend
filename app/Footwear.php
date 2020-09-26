<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Footwear extends Model
{
    protected $fillable = [
        'ad_id', 'gender',
];


public function ad(){
return $this->belongsTo('App\Ad');
}
}

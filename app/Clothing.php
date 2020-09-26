<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clothing extends Model
{
    protected $fillable = [
        'ad_id', 'gender',
];


public function ad(){
return $this->belongsTo('App\Ad');
}
}

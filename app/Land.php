<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Land extends Model
{
    protected $fillable = [
        'ad_id', 'size',  'landmark', 'land_type'
];


public function ad(){
return $this->belongsTo('App\Ad');
}
}

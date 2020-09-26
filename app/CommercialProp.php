<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommercialProp extends Model
{
    protected $fillable = [
        'ad_id', 'size',  'landmark', 'property_id'
];


public function ad(){
return $this->belongsTo('App\Ad');
}

public function property(){
    return $this->belongsTo('App\Property');
    }
}

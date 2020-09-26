<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'ad_id', 'size', 'beds', 'landmark', 'baths'
];


public function ad(){
return $this->belongsTo('App\Ad');
}

}

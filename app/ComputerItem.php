<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComputerItem extends Model
{
    protected $fillable = [
        'computer_accessory_id',
        'ad_id',
    ];



public function ad(){
return $this->belongsTo('App\Ad');
}

public function computer_accessory(){
return $this->belongsTo('App\ComputerAccessory');
}

}

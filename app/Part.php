<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable = [
        'ad_id', 
        'item_type_id',
];


    public function ad(){
    return $this->belongsTo('App\Ad');
}
public function auto_part(){
    return $this->belongsTo('App\AutoPart', 'item_type_id');
}

}

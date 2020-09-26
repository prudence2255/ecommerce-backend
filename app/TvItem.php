<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TvItem extends Model
{
    protected $fillable = [
        'ad_id', 'item_type',
];


public function ad(){
return $this->belongsTo('App\Ad');
}

}

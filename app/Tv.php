<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tv extends Model
{
    protected $fillable = [
        'ad_id', 'tv_brand_id', 'model'
    ];
    
    public function ad(){
        return $this->belongsTo('App\Ad');
    }

    public function tv_brand(){
        return $this->belongsTo('App\TvBrand');
    }
}

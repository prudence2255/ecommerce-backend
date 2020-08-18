<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobilePhone extends Model
{
    protected $fillable = ['edition', 'ad_id', 
                            'mobile_brand_id',
                            'mobile_model_id'
                        ];

    public function ad(){
        return $this->belongsTo('App\Ad');
    }

    public function mobile_brand(){
        return $this->belongsTo('App\MobileBrand');
    }
    public function mobile_model(){
        return $this->belongsTo('App\MobileModel');
    }

    public function mobile_features(){
        return $this->belongsToMany('App\MobileFeature');
    }
}

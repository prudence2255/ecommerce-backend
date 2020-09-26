<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CameraItem extends Model
{
    protected $fillable = [
        'ad_id', 'camera_type_id',
        'camera_brand_id'
];


public function ad(){
return $this->belongsTo('App\Ad');
}

public function camera_type(){
return $this->belongsTo('App\CameraType');
}

public function camera_brand(){
    return $this->belongsTo('App\CameraBrand');
    }
}

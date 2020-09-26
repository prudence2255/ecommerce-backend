<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudioItem extends Model
{
    protected $fillable = [
        'ad_id', 'audio_type_id'
];


public function ad(){
return $this->belongsTo('App\Ad');
}

public function audio_type(){
return $this->belongsTo('App\AudioType');
}


}

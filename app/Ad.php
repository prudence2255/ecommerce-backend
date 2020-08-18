<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'images', 'title', 'uid', 'description', 'price', 'uuid', 'condition'
    ];

    public function mobile_phone()
    {
        return $this->hasOne('App\MobilePhone');
    }
}

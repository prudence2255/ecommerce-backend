<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = [
        'customer_id',
        'provider_name',
        'provider_id',
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}

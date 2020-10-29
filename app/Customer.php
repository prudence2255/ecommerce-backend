<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Cviebrock\EloquentSluggable\Sluggable;


class Customer extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use Sluggable;

    protected $guard = 'customer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'uid', 'slug', 'provider', 'contact'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'contact' => 'array'
    ];

    public function socials(){
        return $this->hasMany('App\Social');
    }

    public function ads(){
        return $this->hasMany('App\Ad');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function getRouteKeyName(){
        return 'slug';
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    



}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Ad extends Model
{
    use Sluggable;
    protected $fillable = [
        'images', 'title', 'description', 'price',
         'uuid', 'condition', 'negotiable', 'parent_category_id',
         'child_category_id', 'parent_location_id', 'child_location_id',
         'category', 'customer_id',
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function customer(){
        return $this->belongsTo('App\Customer');
    }
    public function parent_category(){
        return $this->belongsTo('App\Category', 'parent_category_id');
    }

    public function child_category(){
        return $this->belongsTo('App\Category', 'child_category_id');
    }

    public function child_location(){
        return $this->belongsTo('App\Location', 'child_location_id');
    }

    public function parent_location(){
        return $this->belongsTo('App\Location', 'parent_location_id');
    }

    ///mobile phone
    public function mobile_phones()
    {
        return $this->hasMany('App\MobilePhone');
    }

     ///computers
     public function computers()
     {
         return $this->hasMany('App\Computer');
     }

       ///computer items
       public function computer_items()
       {
           return $this->hasMany('App\ComputerItem');
       }

        ///audio types
        public function audio_items()
        {
            return $this->hasMany('App\AudioItem');
        }

          ///camera types
          public function camera_items()
          {
              return $this->hasMany('App\CameraItem');
          }

          ///tvs
     public function tvs()
     {
         return $this->hasMany('App\Tv');
     }

           ///footwears
           public function footwears()
           {
               return $this->hasMany('App\Footwear');
           }
                 ///clothing
     public function clothing()
     {
         return $this->hasMany('App\Clothing');
     }

           ///beauties
           public function beauties()
           {
               return $this->hasMany('App\Beauty');
           }
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function getRouteKeyName(){
        return 'slug';
    }
}

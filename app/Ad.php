<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Http\Traits\OptionTrait;

class Ad extends Model
{
    use Sluggable;
    use OptionTrait;
    protected $fillable = [
        'images', 'title', 'description', 'price',
         'uuid', 'condition', 'negotiable', 'parent_category_id',
         'child_category_id', 'parent_location_id', 'child_location_id',
         'category', 'customer_id', 'location', 'main_category',
         'main_location'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function setCategoryAttribute($value){
        $this->attributes['category'] = $this->name_transform($value);
    }

    public function setMainCategoryAttribute($value){
        $this->attributes['main_category'] = $this->name_transform($value);
    }

    public function setLocationAttribute($value){
        $this->attributes['location'] = $this->name_transform($value);
    }

    public function setMainLocationAttribute($value){
        $this->attributes['main_location'] = $this->name_transform($value);
    }

    // public function getPriceAttribute($value){
        
    //     return $this->$value + 0;
    // }

    public function delete_images(){
        if($this->images){
            $urls = collect($this->images)->flatten();
            $paths = $urls->all();
            foreach ($paths as $path) {
                  $url = parse_url($path);
                  if(file_exists(public_path($url['path']))){
                    unlink(public_path($url['path']));
                  }
                }
        }
    }
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

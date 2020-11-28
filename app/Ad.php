<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Http\Traits\OptionTrait;
use App\Http\Traits\RelationTrait;

class Ad extends Model
{
    use Sluggable;
    use OptionTrait;
    use RelationTrait;
    
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

    public function getCategoryAttribute($value){
        return $this->name_transform($value);
    }

    public function getLocationAttribute($value){
        return $this->name_transform($value);
    }
   

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
    
   
}

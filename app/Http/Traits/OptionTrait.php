<?php
namespace App\Http\Traits;

use Illuminate\Support\Str;

trait OptionTrait {

    
    public function name_transform($name){
         $names = explode(" ", $name);
        foreach ($names as $i => $value) {
          $names[$i] = ucfirst($value);
        }
        return implode(" ", $names);
    }
    
   
       public function option_transform($items, $name, $parent_name){
          
        foreach ($items as $i => $item) {
          $items[$i] = [
            'id' => $item->id,
            'slug' => $item->slug,
            $name => $this->name_transform($item->$name),
            $parent_name => $item->$parent_name,
            'updated_at' => $item->updated_at,
          ];
        }
        return $items;
    }
    
    public function tag_transform($items, $name){
          
      foreach ($items as $i => $item) {
        $items[$i] = [
          'id' => $item->id,
          'slug' => $item->slug,
          $name => $this->name_transform($item->$name),
          'updated_at' => $item->updated_at,
         
        ];
      }
      return $items;
  }
}
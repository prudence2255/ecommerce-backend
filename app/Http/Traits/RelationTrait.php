<?php
namespace App\Http\Traits;

use Illuminate\Support\Str;

trait RelationTrait {

    
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
    public function mobile_phone()
    {
        return $this->hasOne('App\MobilePhone');
    }

     ///computers
     public function computer()
     {
         return $this->hasOne('App\Computer');
     }

       ///computer items
 public function computer_item()
     {
        return $this->hasOne('App\ComputerItem');
     }

        ///audio types
    public function audio_item()
    {
      return $this->hasOne('App\AudioItem');
     }

    ///camera types
     public function camera_item()
    {
     return $this->hasOne('App\CameraItem');
     }

    ///tvs
     public function tv()
    {
    return $this->hasOne('App\Tv');
    }

///footwears
 public function footwear()
    {
     return $this->hasOne('App\Footwear');
}
                 ///clothing
public function clothing()
{
    return $this->hasOne('App\Clothing');
 }

///beauties
public function beauties()
    {
        return $this->hasOne('App\Beauty');
     }


     public function apartment(){
        return $this->hasOne('App\Apartment');
      }
  
      public function land(){
        return $this->hasOne('App\Land');
      }
  
      public function commercial_prop(){
        return $this->hasOne('App\CommercialProp');
      }
  
      public function house(){
        return $this->hasOne('App\House');
        
      }
  
      public function trade(){
          
        return $this->hasOne('App\Trade');
      }
  
      public function domestic(){
        return $this->hasOne('App\Domestic');
      
      }

      public function event(){
         
        return $this->hasOne('App\Event');
      }

      public function health(){
          
        return $this->hasOne('App\Beauty');
      }
  
      public function car(){
       
        return $this->hasOne('App\Car');
    }
    
        public function motor(){
      
        return $this->hasOne('App\Motor');
     }
  
        public function auto_part(){
     return $this->hasOne('App\Part');
  
        }

     public function home_ap(){
       return $this->hasOne('App\HomeAp');
       
       } 

      public function electricity(){
        return $this->hasOne('App\Electricity');
           
          }

      public function furniture(){
         return $this->hasOne('App\Furniture');
               
          }
     public function tv_item(){
        return $this->hasOne('App\TvItem');
                   
        }

}
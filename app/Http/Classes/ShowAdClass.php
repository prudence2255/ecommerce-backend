<?php

namespace App\Http\Classes;

use App\Apartment;
use App\House;
use App\Land;
use App\CommercialProp;
use App\Ad;
use App\Event;
use App\Domestic;
use App\Health;
use App\Trade;
use App\Part;
use App\Car;
use App\Motor;

class ShowAdClass {
   
    public $ad;

    public function main_data($item){   
      $this->ad = $item; 
      return $this->ad; 
    }

    public function apartment(){
      if($this->ad){
        $item = Apartment::where('ad_id', $this->ad->id)->get();
         return ['ad' => $this->ad, 'item' => $item];
      }
    }

    public function land(){

      if($this->ad){
        $item = Land::where('ad_id', $this->ad->id)->get();
         return ['ad' => $this->ad, 'item' => $item];
      }
    }

    public function commercial_prop(){

      if($this->ad){
        $item = CommercialProp::where('ad_id', $this->ad->id)->with('property')->get();

        return ['ad' => $this->ad, 'item' => $item];
      }
    }

    public function house(){

      if($this->ad){
        $item = House::where('ad_id', $this->ad->id)->get();
         return ['ad' => $this->ad, 'item' => $item];
      }
    }

    public function trade(){
        
      if($this->ad){
        $item = Trade::where('ad_id', $this->ad->id)->get();
        return ['ad' => $this->ad, 'item' => $item];
      }
    }

    public function domestic(){
       
      if($this->ad){
        $item = Domestic::where('ad_id', $this->ad->id)->get();
         return ['ad' => $this->ad, 'item' => $item];
      }
    }
    public function event(){
       
      if($this->ad){
        $item = Event::where('ad_id', $this->ad->id)->get();
         return ['ad' => $this->ad, 'item' => $item];
      }
    }
    public function health(){
        
      if($this->ad){
        $item = Health::where('ad_id', $this->ad->id)->get();
         return ['ad' => $this->ad, 'item' => $item];
      }
    }

    public function car(){
     
    if($this->ad){
      $item = Car::where('ad_id', $this->ad->id)->with(['car_model', 'car_brand'])->get();
       return ['ad' => $this->ad, 'item' => $item];
    }
  }
  
  public function motor(){
    
  if($this->ad){
    $item = Motor::where('ad_id', $this->ad->id)->with(['motor_brand', 'motor_model'])->get();
     return ['ad' => $this->ad, 'item' => $item];
  }
}

public function auto_part(){
  
if($this->ad){
  $item = Part::where('ad_id', $this->ad->id)->with('auto_part')->get();
   return ['ad' => $this->ad, 'item' => $item];
}
}

}
<?php

namespace App\Http\Repositories;

use App\Ad;
use App\Car;
use App\Land;
use App\Part;
use App\Event;
use App\House;
use App\Motor;
use App\Trade;
use App\Health;
use App\Domestic;
use App\Apartment;
use App\CommercialProp;

class ShowAdRepository {

    protected $ad;

    public function __construct($ad){
      $this->ad = $ad;
    }

    public function main_data(){
      return $this->ad;
    }

    public function apartment(){
      if($this->ad){
        $item = Apartment::where('ad_id', $this->ad->id)->first();
         return ['ad' => $this->ad, 'item' => $item];
      }
    }

    public function land(){
      if($this->ad){
        $item = Land::where('ad_id', $this->ad->id)->first();
         return ['ad' => $this->ad, 'item' => $item];
      }
    }

    public function commercial_prop(){

      if($this->ad){
        $item = CommercialProp::where('ad_id', $this->ad->id)->with('property')->first();

        return ['ad' => $this->ad, 'item' => $item];
      }
    }

    public function house(){

      if($this->ad){
        $item = House::where('ad_id', $this->ad->id)->first();
         return ['ad' => $this->ad, 'item' => $item];
      }
    }

    public function trade(){

      if($this->ad){
        $item = Trade::where('ad_id', $this->ad->id)->first();
        return ['ad' => $this->ad, 'item' => $item];
      }
    }

    public function domestic(){

      if($this->ad){
        $item = Domestic::where('ad_id', $this->ad->id)->first();
         return ['ad' => $this->ad, 'item' => $item];
      }
    }
    public function event(){

      if($this->ad){
        $item = Event::where('ad_id', $this->ad->id)->first();
         return ['ad' => $this->ad, 'item' => $item];
      }
    }

    public function health(){

      if($this->ad){
        $item = Health::where('ad_id', $this->ad->id)->first();
         return ['ad' => $this->ad, 'item' => $item];
      }
    }

    public function car(){

    if($this->ad){
      $item = Car::where('ad_id', $this->ad->id)->with(['car_model', 'car_brand'])->first();
       return ['ad' => $this->ad, 'item' => $item];
    }
  }

  public function motor(){

  if($this->ad){
    $item = Motor::where('ad_id', $this->ad->id)->with(['motor_brand', 'motor_model'])->first();
     return ['ad' => $this->ad, 'item' => $item];
  }
}

    public function auto_part(){

    if($this->ad){
  $item = Part::where('ad_id', $this->ad->id)->with('auto_part')->first();
   return ['ad' => $this->ad, 'item' => $item];
    }
    }

}

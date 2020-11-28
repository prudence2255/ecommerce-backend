<?php

namespace App\Http\Repositories;

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
use App\Customer;


class UpdateAdRepository {
   
    protected $ad;
    protected $data;

    public function __construct($ad, $data){
      $this->ad = $ad;
      $this->data = $data;
    }

    public function main_data(){
        $this->data->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required',
            'images' => 'required',
            'contact' => 'required',
        ]);
        $this->ad->slug = null;
       $this->ad->update([
            'parent_category_id' => $this->data->parent_category_id,
            'child_category_id' => $this->data->child_category_id,
            'parent_location_id' => $this->data->parent_location_id,
            'child_location_id' => $this->data->child_location_id,
            'customer_id' => $this->data->user()->id,
            'category' => $this->data->category,
            'main_category' => $this->data->main_category,
            'main_location' => $this->data->main_location,
            'location' => $this->data->location,
            'title' => $this->data->title,
            'condition' => $this->data->condition,
            'description' => $this->data->description,
            'price' => $this->data->price,
            'images' => $this->data->images,
            'negotiable' => $this->data->negotiable,
        ]);
        if($this->ad){
          $customer = Customer::where('id', $this->data->user()->id)->first();
          $customer->update(['contact' => $this->data->contact]);
        }
      return $this->ad;  
    }

    public function apartment(){
        $this->data->validate([
            'beds' => 'required',
            'baths' => 'required',
            'landmark' => 'nullable|string',
            'size' => 'required',
        ]);
    
      if($this->ad){
        $item = Apartment::where('ad_id', $this->ad->id)->first();
     $item->update([
            'beds' => $this->data->beds,
            'baths' => $this->data->baths,
            'ad_id' => $this->ad->id,
            'landmark' => $this->data->landmark,
            'size' => $this->data->size,
        ]);
        return $item->ad;
      }
    }

    public function land(){
        $this->data->validate([
            'land_type' => 'required',
            'landmark' => 'nullable|string',
            'size' => 'required',
        ]);
       
      if($this->ad){
        $item = Land::where('ad_id', $this->ad->id)->first();
        $item->update([
            'land_type' => $this->data->land_type,
            'ad_id' => $this->ad->id,
            'landmark' => $this->data->landmark,
            'size' => $this->data->size,
        ]);
        return $item->ad;
      }
    }

    public function commercial_prop(){
        $this->data->validate([
            'property_id' => 'required',
            'landmark' => 'nullable|string',
            'size' => 'required',
        ]);
        
      if($this->ad){
        $item = CommercialProp::where('ad_id', $this->ad->id)->first();
       $item->update([
            'property_id' => $this->data->property_id,
            'ad_id' => $this->ad->id,
            'landmark' => $this->data->landmark,
            'size' => $this->data->size,
        ]);
        return $item->ad;
      }
    }

    public function house(){
        $this->data->validate([
            'beds' => 'required',
            'baths' => 'required',
            'landmark' => 'nullable|string',
            'size' => 'required',
        ]);
        
      if($this->ad){
        $item = House::where('ad_id', $this->ad->id)->first();
       $item->update([
            'beds' => $this->data->beds,
            'baths' => $this->data->baths,
            'ad_id' => $this->ad->id,
            'landmark' => $this->data->landmark,
            'size' => $this->data->size,
        ]);
        return $item->ad;
      }
    }

    public function trade(){
        $this->data->validate([
            'service_type' => 'required',
        ]);
       
      if($this->ad){
        $item = Trade::where('ad_id', $this->ad->id)->first();
      $item->update([
            'service_type' => $this->data->service_type,
            'ad_id' => $this->ad->id,
        ]);
        return $item->ad;
      }
    }

    public function domestic(){
        $this->data->validate([
            'service_type' => 'required',
        ]);
        
      if($this->ad){
        $item = Domestic::where('ad_id', $this->ad->id)->first();
      $item->update([
            'service_type' => $this->data->service_type,
            'ad_id' => $this->ad->id,
        ]);
        return $item->ad;
      }
    }
    public function event(){
        
        $this->data->validate([
            'service_type' => 'required',
        ]);
        
      if($this->ad){
        $item = Event::where('ad_id', $this->ad->id)->first();
     $item->update([
            'service_type' => $this->data->service_type,
            'ad_id' => $this->ad->id,
        ]);
        return $item->ad;
      }
    }
    public function health(){
        $this->data->validate([
            'service_type' => 'required',
        ]);
        
      if($this->ad){
        $item = Health::where('ad_id', $this->ad->id)->first();
       $item->update([
            'service_type' => $this->data->service_type,
            'ad_id' => $this->ad->id,
        ]);
        return $item->ad;
      }
    }

    public function car(){
      $this->data->validate([
        'car_brand_id' => 'required',
        'car_model_id' => 'required',
        'model_year' => 'required|string',
        'mileage' => 'required|string',
        'transmission' => 'required|string',
        'fuel_type' => 'required|string',
        'engine_capacity' => 'required|string',
        'edition' => 'nullable|string'
      ]);
     
    if($this->ad){
      $item = Car::where('ad_id', $this->ad->id)->first();
    $item->update([
        'car_brand_id' => $this->data->car_brand_id,
        'car_model_id' => $this->data->car_model_id,
        'model_year' => $this->data->model_year,
        'mileage' => $this->data->mileage,
        'transmission' => $this->data->transmission,
        'fuel_type' => $this->data->fuel_type,
        'edition' => $this->data->edition,
        'engine_capacity' => $this->data->engine_capacity,
         'ad_id' => $this->ad->id,
      ]);
      return $item->ad;
    }
  }
  
  public function motor(){
    $this->data->validate([
      'motor_brand_id' => 'required',
      'motor_model_id' => 'required',
      'model_year' => 'required|string',
      'mileage' => 'required|string',
      'engine_capacity' => 'required|string',
      'edition' => 'nullable|string'
    ]);
    
  if($this->ad){
    $item = Motor::where('ad_id', $this->ad->id)->first();
    $item->update([
      'motor_brand_id' => $this->data->motor_brand_id,
      'motor_model_id' => $this->data->motor_model_id,
      'model_year' => $this->data->model_year,
      'mileage' => $this->data->mileage,
      'edition' => $this->data->edition,
      'engine_capacity' => $this->data->engine_capacity,
       'ad_id' => $this->ad->id,
    ]);
    return $item->ad;
  }
}

public function auto_part(){
  $this->data->validate([
      'item_type_id' => 'required',
  ]);
  
if($this->ad){
  $item = Part::where('ad_id', $this->ad->id)->first();
$item->update([
      'item_type_id' => $this->data->item_type_id,
      'ad_id' => $this->ad->id,
  ]);
  return $item->ad;
}
}

}
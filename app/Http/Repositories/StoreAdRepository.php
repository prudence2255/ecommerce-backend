<?php

namespace App\Http\Repositories;

use App\Apartment;
use App\House;
use App\Customer;
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
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StoreAdRepository {
   
    protected $data;
    protected $ad;

    public function __construct($data){
      $this->data = $data;
    }
    
    public function main_data(){
        $this->data->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required',
            'images' => 'required',
            'contact' => 'required'
        ]);

       $this->ad = Ad::Create(
           [
            'parent_category_id' => $this->data->parent_category_id,
            'child_category_id' => $this->data->child_category_id,
            'parent_location_id' => $this->data->parent_location_id,
            'child_location_id' => $this->data->child_location_id,
            'main_category' => $this->data->main_category,
            'main_location' => $this->data->main_location,
            'customer_id' => $this->data->user()->id,
            'category' => $this->data->category,
            'location' => $this->data->location,
            'title' => $this->data->title,
            'condition' => $this->data->condition,
            'description' => $this->data->description,
            'price' => $this->data->price,
            'images' => $this->data->images,
            'negotiable' => $this->data->negotiable,
            'uuid' => IdGenerator::generate(['table' => 'users','field' =>'uid', 
                                        'length' => 6, 'prefix' => date('y')])
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
        $apart = Apartment::create([
            'beds' => $this->data->beds,
            'baths' => $this->data->baths,
            'ad_id' => $this->ad->id,
            'landmark' => $this->data->landmark,
            'size' => $this->data->size,
        ]);
        return $apart->ad;
      }
    }

    public function land(){
        $this->data->validate([
            'land_type' => 'required',
            'landmark' => 'nullable|string',
            'size' => 'required',
        ]);

      if($this->ad){
        $land = Land::create([
            'land_type' => $this->data->land_type,
            'ad_id' => $this->ad->id,
            'landmark' => $this->data->landmark,
            'size' => $this->data->size,
        ]);
        return $land->ad;
      }
    }

    public function commercial_prop(){
        $this->data->validate([
            'property_id' => 'required',
            'landmark' => 'nullable|string',
            'size' => 'required',
        ]);

      if($this->ad){
        $com = CommercialProp::create([
            'property_id' => $this->data->property_id,
            'ad_id' => $this->ad->id,
            'landmark' => $this->data->landmark,
            'size' => $this->data->size,
        ]);
        return $com->ad;
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
        $house = House::create([
            'beds' => $this->data->beds,
            'baths' => $this->data->baths,
            'ad_id' => $this->ad->id,
            'landmark' => $this->data->landmark,
            'size' => $this->data->size,
        ]);
        return $house->ad;
      }
    }

    public function trade(){
        $this->data->validate([
            'service_type' => 'required',
        ]);

      if($this->ad){
        $trade = Trade::create([
            'service_type' => $this->data->service_type,
            'ad_id' => $this->ad->id,
        ]);
        return $trade->ad;
      }
    }

    public function domestic(){
        $this->data->validate([
            'service_type' => 'required',
        ]);

      if($this->ad){
        $dom = Domestic::create([
            'service_type' => $this->data->service_type,
            'ad_id' => $this->ad->id,
        ]);
        return $dom->ad;
      }
    }
    public function event(){
        
        $this->data->validate([
            'service_type' => 'required',
        ]);

      if($this->ad){
        $event = Event::create([
            'service_type' => $this->data->service_type,
            'ad_id' => $this->ad->id,
        ]);
        return $event->ad;
      }
    }
    
    public function health(){
        $this->data->validate([
            'service_type' => 'required',
        ]);

      if($this->ad){
        $health = Health::create([
            'service_type' => $this->data->service_type,
            'ad_id' => $this->ad->id,
        ]);
        return $health->ad;
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
      $car = Car::create([
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
      return $car->ad;
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
    $motor = Motor::create([
      'motor_brand_id' => $this->data->motor_brand_id,
      'motor_model_id' => $this->data->motor_model_id,
      'model_year' => $this->data->model_year,
      'mileage' => $this->data->mileage,
      'edition' => $this->data->edition,
      'engine_capacity' => $this->data->engine_capacity,
       'ad_id' => $this->ad->id,
    ]);
    return $motor->ad;
  }
}

public function auto_part(){
  $this->data->validate([
      'item_type_id' => 'required',
  ]);

if($this->ad){
  $part = Part::create([
      'item_type_id' => $this->data->item_type_id,
      'ad_id' => $this->ad->id,
  ]);
  return $part->ad;
}
}

}
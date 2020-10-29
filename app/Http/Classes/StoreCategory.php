<?php

namespace App\Http\Classes;

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

class StoreCategory {
   
    public $ad;

    public function main_data($request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required',
            'images' => 'required',
            'contact' => 'required'
        ]);

       $this->ad = Ad::Create(
           [
            'parent_category_id' => $request->parent_category_id,
            'child_category_id' => $request->child_category_id,
            'parent_location_id' => $request->parent_location_id,
            'child_location_id' => $request->child_location_id,
            'main_category' => $request->main_category,
            'main_location' => $request->main_location,
            'customer_id' => $request->user()->id,
            'category' => $request->category,
            'location' => $request->location,
            'title' => $request->title,
            'condition' => $request->condition,
            'description' => $request->description,
            'price' => $request->price,
            'images' => $request->images,
            'negotiable' => $request->negotiable,
            'uuid' => IdGenerator::generate(['table' => 'users','field' =>'uid', 
                                        'length' => 6, 'prefix' => date('y')])
        ]);
        if($this->ad){
          $customer = Customer::where('id', $request->user()->id)->first();
          $customer->update(['contact' => $request->contact]);
        }
      return $this->ad;  
    }

    public function apartment($request){
        $request->validate([
            'beds' => 'required',
            'baths' => 'required',
            'landmark' => 'nullable|string',
            'size' => 'required',
        ]);

      if($this->ad){
        $apart = Apartment::create([
            'beds' => $request->beds,
            'baths' => $request->baths,
            'ad_id' => $this->ad->id,
            'landmark' => $request->landmark,
            'size' => $request->size,
        ]);
        return $apart->ad;
      }
    }

    public function land($request){
        $request->validate([
            'land_type' => 'required',
            'landmark' => 'nullable|string',
            'size' => 'required',
        ]);

      if($this->ad){
        $land = Land::create([
            'land_type' => $request->land_type,
            'ad_id' => $this->ad->id,
            'landmark' => $request->landmark,
            'size' => $request->size,
        ]);
        return $land->ad;
      }
    }

    public function commercial_prop($request){
        $request->validate([
            'property_id' => 'required',
            'landmark' => 'nullable|string',
            'size' => 'required',
        ]);

      if($this->ad){
        $com = CommercialProp::create([
            'property_id' => $request->property_id,
            'ad_id' => $this->ad->id,
            'landmark' => $request->landmark,
            'size' => $request->size,
        ]);
        return $com->ad;
      }
    }

    public function house($request){
        $request->validate([
            'beds' => 'required',
            'baths' => 'required',
            'landmark' => 'nullable|string',
            'size' => 'required',
        ]);

      if($this->ad){
        $house = House::create([
            'beds' => $request->beds,
            'baths' => $request->baths,
            'ad_id' => $this->ad->id,
            'landmark' => $request->landmark,
            'size' => $request->size,
        ]);
        return $house->ad;
      }
    }

    public function trade($request){
        $request->validate([
            'service_type' => 'required',
        ]);

      if($this->ad){
        $trade = Trade::create([
            'service_type' => $request->service_type,
            'ad_id' => $this->ad->id,
        ]);
        return $trade->ad;
      }
    }

    public function domestic($request){
        $request->validate([
            'service_type' => 'required',
        ]);

      if($this->ad){
        $dom = Domestic::create([
            'service_type' => $request->service_type,
            'ad_id' => $this->ad->id,
        ]);
        return $dom->ad;
      }
    }
    public function event($request){
        
        $request->validate([
            'service_type' => 'required',
        ]);

      if($this->ad){
        $event = Event::create([
            'service_type' => $request->service_type,
            'ad_id' => $this->ad->id,
        ]);
        return $event->ad;
      }
    }
    
    public function health($request){
        $request->validate([
            'service_type' => 'required',
        ]);

      if($this->ad){
        $health = Health::create([
            'service_type' => $request->service_type,
            'ad_id' => $this->ad->id,
        ]);
        return $health->ad;
      }
    }

    public function car($request){
      $request->validate([
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
        'car_brand_id' => $request->car_brand_id,
        'car_model_id' => $request->car_model_id,
        'model_year' => $request->model_year,
        'mileage' => $request->mileage,
        'transmission' => $request->transmission,
        'fuel_type' => $request->fuel_type,
        'edition' => $request->edition,
        'engine_capacity' => $request->engine_capacity,
         'ad_id' => $this->ad->id,
      ]);
      return $car->ad;
    }
  }
  
  public function motor($request){
    $request->validate([
      'motor_brand_id' => 'required',
      'motor_model_id' => 'required',
      'model_year' => 'required|string',
      'mileage' => 'required|string',
      'engine_capacity' => 'required|string',
      'edition' => 'nullable|string'
    ]);
  if($this->ad){
    $motor = Motor::create([
      'motor_brand_id' => $request->motor_brand_id,
      'motor_model_id' => $request->motor_model_id,
      'model_year' => $request->model_year,
      'mileage' => $request->mileage,
      'edition' => $request->edition,
      'engine_capacity' => $request->engine_capacity,
       'ad_id' => $this->ad->id,
    ]);
    return $motor->ad;
  }
}

public function auto_part($request){
  $request->validate([
      'item_type_id' => 'required',
  ]);

if($this->ad){
  $part = Part::create([
      'item_type_id' => $request->item_type_id,
      'ad_id' => $this->ad->id,
  ]);
  return $part->ad;
}
}

}
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
use App\Customer;


class UpdateCategory {
   
    public $ad;

    public function main_data($request, $item){
      $this->ad = $item;
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required',
            'images' => 'required',
            'contact' => 'required',
        ]);
       $this->ad->update([
            'parent_category_id' => $request->parent_category_id,
            'child_category_id' => $request->child_category_id,
            'parent_location_id' => $request->parent_location_id,
            'child_location_id' => $request->child_location_id,
            'customer_id' => $request->user()->id,
            'category' => $request->category,
            'main_category' => $request->main_category,
            'main_location' => $request->main_location,
            'location' => $request->location,
            'title' => $request->title,
            'condition' => $request->condition,
            'description' => $request->description,
            'price' => $request->price,
            'images' => $request->images,
            'negotiable' => $request->negotiable,
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
     $item = Apartment::where('ad_id', $this->ad->id)->first();
      if($this->ad){
     $item->update([
            'beds' => $request->beds,
            'baths' => $request->baths,
            'ad_id' => $this->ad->id,
            'landmark' => $request->landmark,
            'size' => $request->size,
        ]);
        return $item->ad;
      }
    }

    public function land($request){
        $request->validate([
            'land_type' => 'required',
            'landmark' => 'nullable|string',
            'size' => 'required',
        ]);
        $item = Land::where('ad_id', $this->ad->id)->first();
      if($this->ad){
        $item->update([
            'land_type' => $request->land_type,
            'ad_id' => $this->ad->id,
            'landmark' => $request->landmark,
            'size' => $request->size,
        ]);
        return $item->ad;
      }
    }

    public function commercial_prop($request){
        $request->validate([
            'property_id' => 'required',
            'landmark' => 'nullable|string',
            'size' => 'required',
        ]);
        $item = CommercialProp::where('ad_id', $this->ad->id)->first();
      if($this->ad){
       $item->update([
            'property_id' => $request->property_id,
            'ad_id' => $this->ad->id,
            'landmark' => $request->landmark,
            'size' => $request->size,
        ]);
        return $item->ad;
      }
    }

    public function house($request){
        $request->validate([
            'beds' => 'required',
            'baths' => 'required',
            'landmark' => 'nullable|string',
            'size' => 'required',
        ]);
        $item = House::where('ad_id', $this->ad->id)->first();
      if($this->ad){
       $item->update([
            'beds' => $request->beds,
            'baths' => $request->baths,
            'ad_id' => $this->ad->id,
            'landmark' => $request->landmark,
            'size' => $request->size,
        ]);
        return $item->ad;
      }
    }

    public function trade($request){
        $request->validate([
            'service_type' => 'required',
        ]);
        $item = Trade::where('ad_id', $this->ad->id)->first();
      if($this->ad){
      $item->update([
            'service_type' => $request->service_type,
            'ad_id' => $this->ad->id,
        ]);
        return $item->ad;
      }
    }

    public function domestic($request){
        $request->validate([
            'service_type' => 'required',
        ]);
        $item = Domestic::where('ad_id', $this->ad->id)->first();
      if($this->ad){
      $item->update([
            'service_type' => $request->service_type,
            'ad_id' => $this->ad->id,
        ]);
        return $item->ad;
      }
    }
    public function event($request){
        
        $request->validate([
            'service_type' => 'required',
        ]);
        $item = Event::where('ad_id', $this->ad->id)->first();
      if($this->ad){
     $item->update([
            'service_type' => $request->service_type,
            'ad_id' => $this->ad->id,
        ]);
        return $item->ad;
      }
    }
    public function health($request){
        $request->validate([
            'service_type' => 'required',
        ]);
        $item = Health::where('ad_id', $this->ad->id)->first();
      if($this->ad){
       $item->update([
            'service_type' => $request->service_type,
            'ad_id' => $this->ad->id,
        ]);
        return $item->ad;
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
      $item = Car::where('ad_id', $this->ad->id)->first();
    if($this->ad){
    $item->update([
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
      return $item->ad;
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
    $item = Motor::where('ad_id', $this->ad->id)->first();
  if($this->ad){
    $item->update([
      'motor_brand_id' => $request->motor_brand_id,
      'motor_model_id' => $request->motor_model_id,
      'model_year' => $request->model_year,
      'mileage' => $request->mileage,
      'edition' => $request->edition,
      'engine_capacity' => $request->engine_capacity,
       'ad_id' => $this->ad->id,
    ]);
    return $item->ad;
  }
}

public function auto_part($request){
  $request->validate([
      'item_type_id' => 'required',
  ]);
  $item = Part::where('ad_id', $this->ad->id)->first();
if($this->ad){
$item->update([
      'item_type_id' => $request->item_type_id,
      'ad_id' => $this->ad->id,
  ]);
  return $item->ad;
}
}

}
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
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Category {
   
    public $ad;

    public function main_data($request){
        $request->validate([
            'title' => 'required|string',
            'condition' => 'required',
            'description' => 'required|string',
            'price' => 'required',
            'images' => 'required',
        ]);

       $this->ad = Ad::create([
            'parent_category_id' => $request->parent_category_id,
            'child_category_id' => $request->child_category_id,
            'parent_location_id' => $request->parent_location_id,
            'child_location_id' => $request->child_location_id,
            'customer_id' => $request->user()->id,
            'category' => $request->category,
            'title' => $request->title,
            'condition' => $request->condition,
            'description' => $request->description,
            'price' => $request->price,
            'images' => $request->images,
            'negotiable' => $request->negotiable,
            'uuid' => IdGenerator::generate(['table' => 'users','field' =>'uid', 
                                        'length' => 6, 'prefix' => date('y')])
        ]);
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
            'service_type' => 'required',
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
            'service_type' => 'required',
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
            'service_type' => 'required',
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
            'service_type' => 'required',
            'ad_id' => $this->ad->id,
        ]);
        return $health->ad;
      }
    }

}
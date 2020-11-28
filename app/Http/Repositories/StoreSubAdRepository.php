<?php


namespace App\Http\Repositories;

use App\Http\Repositories\StoreAdRepository;
use App\Ad;
use App\MobilePhone;
use App\Computer;
use App\ComputerItem;
use App\AudioItem;
use App\Tv;
use App\TvItem;
use App\CameraItem;
use App\Beauty;
use App\Clothing;
use App\Electricity;
use App\HomeAp;
use App\Furniture;
use App\Footwear;
use Illuminate\Support\Facades\DB;

class StoreSubAdRepository extends StoreAdRepository{
       
    public function mobile_phone(){
        $this->data->validate([
            'mobile_brand_id' => 'required',
            'mobile_model_id' => 'required',
            'edition' => 'nullable|string',
        ]);

      if($this->ad){
        $mobile = MobilePhone::Create([
            'mobile_brand_id' => $this->data->mobile_brand_id,
            'mobile_model_id' => $this->data->mobile_model_id,
            'ad_id' => $this->ad->id,
            'edition' => $this->data->edition,
            'features' => $this->data->features,
        ]);
        return $mobile->ad;
      }
    }

    public function computer(){
        $this->data->validate([
            'computer_brand_id' => 'required',
            'model' => 'required|string',
            'device' => 'required',
        ]);

      if($this->ad){
        $computer = Computer::Create([
            'computer_brand_id' => $this->data->computer_brand_id,
            'device' => $this->data->device,
            'ad_id' => $this->ad->id,
            'model' => $this->data->model,
        ]);
        return $computer->ad;
      }
    }

    public function computer_item(){
        $this->data->validate([
            'computer_accessory_id' => 'required',
        ]);

      if($this->ad){
        $computer_accessory = ComputerItem::create([
            'computer_accessory_id' => $this->data->computer_accessory_id,
            'ad_id' => $this->ad->id,
        ]);
        return $computer_accessory->ad;
      }
    }
    
    public function audio_item(){
        $this->data->validate([
            'audio_type_id' => 'required',
        ]);

      if($this->ad){
        $audio_type = AudioItem::create([
            'audio_type_id' => $this->data->audio_type_id,
            'ad_id' => $this->ad->id,
        ]);
        return $audio_type->ad;
      }

    }

    public function camera_item(){
        $this->data->validate([
            'camera_type_id' => 'required',
            'camera_brand_id' => 'required',
        ]);

      if($this->ad){
        $camera_type = CameraItem::create([
            'camera_type_id' => $this->data->camera_type_id,
            'camera_brand_id' => $this->data->camera_brand_id,
            'ad_id' => $this->ad->id,
        ]);
        return $camera_type->ad;
      }

    }  

    public function tv(){
      $this->data->validate([
          'tv_brand_id' => 'required',
          'model' => 'required|string',
      ]);

    if($this->ad){
      $tv = Tv::create([
          'tv_brand_id' => $this->data->tv_brand_id,
          'ad_id' => $this->ad->id,
          'model' => $this->data->model,
      ]);
      return $tv->ad;
    }
  }

  public function tv_item(){
    $this->data->validate([
        'item_type' => 'required',
    ]);

  if($this->ad){
    $tv_accessory = TvItem::create([
        'item_type' => $this->data->item_type,
        'ad_id' => $this->ad->id,
    ]);
    return $tv_accessory->ad;
  }
}

public function beauty(){
  $this->data->validate([
      'item_type' => 'required',
  ]);

if($this->ad){
  $beauty = Beauty::create([
      'item_type' => $this->data->item_type,
      'ad_id' => $this->ad->id,
  ]);
  return $beauty->ad;
}
}

public function clothing(){
  $this->data->validate([
      'gender' => 'required',
  ]);

if($this->ad){
  $clothing = Clothing::create([
      'gender' => $this->data->gender,
      'ad_id' => $this->ad->id,
  ]);
  return $clothing->ad;
}
}

public function footwear(){
  $this->data->validate([
      'gender' => 'required',
  ]);

if($this->ad){
  $footwear = Footwear::create([
      'gender' => $this->data->gender,
      'ad_id' => $this->ad->id,
  ]);
  return $footwear->ad;
}
}

public function electricity(){
  $this->data->validate([
      'item_type' => 'required',
  ]);

if($this->ad){
  $elect = Electricity::create([
      'item_type' => $this->data->item_type,
      'ad_id' => $this->ad->id,
  ]);
  return $elect->ad;
}
}

public function home_ap(){
  $this->data->validate([
      'item_type' => 'required',
  ]);

if($this->ad){
  $home = HomeAp::create([
      'item_type' => $this->data->item_type,
      'ad_id' => $this->ad->id,
  ]);
  return $home->ad;
}
}

public function furniture(){
  $this->data->validate([
      'furniture_type' => 'required',
  ]);

if($this->ad){
  $furniture = Furniture::create([
      'furniture_type' => $this->data->furniture_type,
      'ad_id' => $this->ad->id,
  ]);
  return $furniture->ad;
}
}
}

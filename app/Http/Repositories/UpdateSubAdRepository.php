<?php


namespace App\Http\Repositories;

use App\Http\Repositories\UpdateAdRepository;
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

class UpdateSubAdRepository extends UpdateAdRepository{
       
    public function mobile_phone(){
        $this->data->validate([
            'mobile_brand_id' => 'required',
            'mobile_model_id' => 'required',
            'edition' => 'nullable|string',
        ]);

       
        
      if($this->ad){
        $item = MobilePhone::where('ad_id', $this->ad->id)->first();
          $item->update([
            'mobile_brand_id' => $this->data->mobile_brand_id,
            'mobile_model_id' => $this->data->mobile_model_id,
            'ad_id' => $this->ad->id,
            'edition' => $this->data->edition,
            'features' => $this->data->features,
        ]);
        return $item->ad;
      }
    }

    public function computer(){
        $this->data->validate([
            'computer_brand_id' => 'required',
            'model' => 'required|string',
            'device' => 'required',
        ]);
        
      if($this->ad){
        $item = Computer::where('ad_id', $this->ad->id)->first();  
        $item->update([
            'computer_brand_id' => $this->data->computer_brand_id,
            'device' => $this->data->device,
            'ad_id' => $this->ad->id,
            'model' => $this->data->model,
        ]);
        return $item->ad;
      }
    }

    public function computer_item(){
        $this->data->validate([
            'computer_accessory_id' => 'required',
        ]);
        
      if($this->ad){
      $item = ComputerItem::where('ad_id', $this->ad->id)->first();
     $item->update([
            'computer_accessory_id' => $this->data->computer_accessory_id,
            'ad_id' => $this->ad->id,
        ]);
       return $item->ad;
      }
    }
    
    public function audio_item(){
        $this->data->validate([
            'audio_type_id' => 'required',
        ]);
        
      if($this->ad){
        $item = AudioItem::where('ad_id', $this->ad->id)->first();
         $item->update([
            'audio_type_id' => $this->data->audio_type_id,
            'ad_id' => $this->ad->id,
        ]);
        return $item->ad;
      }

    }

    public function camera_item(){
        $this->data->validate([
            'camera_type_id' => 'required',
            'camera_brand_id' => 'required',
        ]);
        
      if($this->ad){
        $item = CameraItem::where('ad_id', $this->ad->id)->first();
       $item->update([
            'camera_type_id' => $this->data->camera_type_id,
            'camera_brand_id' => $this->data->camera_brand_id,
            'ad_id' => $this->ad->id,
        ]);
        return $item->ad;
      }

    }  

    public function tv(){
      $this->data->validate([
          'tv_brand_id' => 'required',
          'model' => 'required|string',
      ]);
      
    if($this->ad){
      $item = Tv::where('ad_id', $this->ad->id)->first();
      $item->update([
          'tv_brand_id' => $this->data->tv_brand_id,
          'ad_id' => $this->ad->id,
          'model' => $this->data->model,
      ]);
      return $item->ad;
    }
  }

  public function tv_item(){
    $this->data->validate([
        'item_type' => 'required',
    ]);
    
  if($this->ad){
    $item = TvItem::where('ad_id', $this->ad->id)->first();
 $item->update([
        'item_type' => $this->data->item_type,
        'ad_id' => $this->ad->id,
    ]);
    return $item->ad;
  }
}

public function beauty(){
  $this->data->validate([
      'item_type' => 'required',
  ]);
  
if($this->ad){
  $item = Beauty::where('ad_id', $this->ad->id)->first();
$item->update([
      'item_type' => $this->data->item_type,
      'ad_id' => $this->ad->id,
  ]);
  return $item->ad;
}
}

public function clothing(){
  $this->data->validate([
      'gender' => 'required',
  ]);
  
if($this->ad){
  $item = Clothing::where('ad_id', $this->ad->id)->first();
$item->update([
      'gender' => $this->data->gender,
      'ad_id' => $this->ad->id,
  ]);
  return $item->ad;
}
}

public function footwear(){
  $this->data->validate([
      'gender' => 'required',
  ]);
  
if($this->ad){
  $item = Footwear::where('ad_id', $this->ad->id)->first();
   $item->update([
      'gender' => $this->data->gender,
      'ad_id' => $this->ad->id,
  ]);
  return $item->ad;
}
}

public function electricity(){
  $this->data->validate([
      'item_type' => 'required',
  ]);
  
if($this->ad){
  $item = Electricity::where('ad_id', $this->ad->id)->first();
 $item->update([
      'item_type' => $this->data->item_type,
      'ad_id' => $this->ad->id,
  ]);
  return $item->ad;
}
}

public function home_ap(){
  $this->data->validate([
      'item_type' => 'required',
  ]);
  
if($this->ad){
  $item = HomeAp::where('ad_id', $this->ad->id)->first();
 $item->update([
      'item_type' => $this->data->item_type,
      'ad_id' => $this->ad->id,
  ]);
  return $item->ad;
}
}

public function furniture(){
  $this->data->validate([
      'furniture_type' => 'required',
  ]);
  
if($this->ad){
  $item = Furniture::where('ad_id', $this->ad->id)->first();
 $item->update([
      'furniture_type' => $this->data->furniture_type,
      'ad_id' => $this->ad->id,
  ]);
  return $item->ad;
}
}
}

<?php


namespace App\Http\Classes;

use App\Http\Classes\UpdateCategory;
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

class UpdateSubCategory extends UpdateCategory{
       
    public function mobile_phone($request){
        $request->validate([
            'mobile_brand_id' => 'required',
            'mobile_model_id' => 'required',
            'edition' => 'nullable|string',
        ]);
        $item = MobilePhone::where('ad_id', $this->ad->id)->first();
      if($this->ad){
          $item->update([
            'mobile_brand_id' => $request->mobile_brand_id,
            'mobile_model_id' => $request->mobile_model_id,
            'ad_id' => $this->ad->id,
            'edition' => $request->edition,
            'features' => $request->features,
        ]);
        return $item->ad;
      }
    }

    public function computer($request){
        $request->validate([
            'computer_brand_id' => 'required',
            'model' => 'required|string',
            'device' => 'required',
        ]);
        $item = Computer::where('ad_id', $this->ad->id)->first();
      if($this->ad){  
        $item->update([
            'computer_brand_id' => $request->computer_brand_id,
            'device' => $request->device,
            'ad_id' => $this->ad->id,
            'model' => $request->model,
        ]);
        return $item->ad;
      }
    }

    public function computer_item($request){
        $request->validate([
            'computer_accessory_id' => 'required',
        ]);
        $item = ComputerItem::where('ad_id', $this->ad->id)->first();
      if($this->ad){
     $item->update([
            'computer_accessory_id' => $request->computer_accessory_id,
            'ad_id' => $this->ad->id,
        ]);
       return $item->ad;
      }
    }
    
    public function audio_type($request){
        $request->validate([
            'audio_type_id' => 'required',
        ]);
        $item = AudioItem::where('ad_id', $this->ad->id)->first();
      if($this->ad){
         $item->update([
            'audio_type_id' => $request->audio_type_id,
            'ad_id' => $this->ad->id,
        ]);
        return $item->ad;
      }

    }

    public function camera_type($request){
        $request->validate([
            'camera_type_id' => 'required',
            'camera_brand_id' => 'required',
        ]);
        $item = CameraItem::where('ad_id', $this->ad->id)->first();
      if($this->ad){
       $item->update([
            'camera_type_id' => $request->camera_type_id,
            'camera_brand_id' => $request->camera_brand_id,
            'ad_id' => $this->ad->id,
        ]);
        return $item->ad;
      }

    }  

    public function tv($request){
      $request->validate([
          'tv_brand_id' => 'required',
          'model' => 'required|string',
      ]);
      $item = Tv::where('ad_id', $this->ad->id)->first();
    if($this->ad){
      $item->update([
          'tv_brand_id' => $request->tv_brand_id,
          'ad_id' => $this->ad->id,
          'model' => $request->model,
      ]);
      return $item->ad;
    }
  }

  public function tv_item($request){
    $request->validate([
        'item_type' => 'required',
    ]);
    $item = TvItem::where('ad_id', $this->ad->id)->first();
  if($this->ad){
 $item->update([
        'item_type' => $request->item_type,
        'ad_id' => $this->ad->id,
    ]);
    return $item->ad;
  }
}

public function beauty($request){
  $request->validate([
      'item_type' => 'required',
  ]);
  $item = Beauty::where('ad_id', $this->ad->id)->first();
if($this->ad){
$item->update([
      'item_type' => $request->item_type,
      'ad_id' => $this->ad->id,
  ]);
  return $item->ad;
}
}

public function clothing($request){
  $request->validate([
      'gender' => 'required',
  ]);
  $item = Clothing::where('ad_id', $this->ad->id)->first();
if($this->ad){
$item->update([
      'gender' => $request->gender,
      'ad_id' => $this->ad->id,
  ]);
  return $item->ad;
}
}

public function footwear($request){
  $request->validate([
      'gender' => 'required',
  ]);
  $item = Footwear::where('ad_id', $this->ad->id)->first();
if($this->ad){
   $item->update([
      'gender' => $request->gender,
      'ad_id' => $this->ad->id,
  ]);
  return $item->ad;
}
}

public function electricity($request){
  $request->validate([
      'item_type' => 'required',
  ]);
  $item = Electricity::where('ad_id', $this->ad->id)->first();
if($this->ad){
 $item->update([
      'item_type' => $request->item_type,
      'ad_id' => $this->ad->id,
  ]);
  return $item->ad;
}
}

public function home_ap($request){
  $request->validate([
      'item_type' => 'required',
  ]);
  $item = HomeAp::where('ad_id', $this->ad->id)->first();
if($this->ad){
 $item->update([
      'item_type' => $request->item_type,
      'ad_id' => $this->ad->id,
  ]);
  return $item->ad;
}
}

public function furniture($request){
  $request->validate([
      'furniture_type' => 'required',
  ]);
  $item = Furniture::where('ad_id', $this->ad->id)->first();
if($this->ad){
 $item->update([
      'furniture_type' => $request->furniture_type,
      'ad_id' => $this->ad->id,
  ]);
  return $item->ad;
}
}
}

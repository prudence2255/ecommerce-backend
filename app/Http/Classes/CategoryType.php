<?php


namespace App\Http\Classes;

use App\Http\Classes\Category;
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
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\DB;

class CategoryType extends Category{
       
    public function mobile_phone($request){
        $request->validate([
            'mobile_brand_id' => 'required',
            'mobile_model_id' => 'required',
            'edition' => 'nullable|string',
        ]);

      if($this->ad){
        $mobile = MobilePhone::create([
            'mobile_brand_id' => $request->mobile_brand_id,
            'mobile_model_id' => $request->mobile_model_id,
            'ad_id' => $this->ad->id,
            'edition' => $request->edition,
            'features' => $request->features,
        ]);
        return $mobile->ad;
      }
    }

    public function computer($request){
        $request->validate([
            'computer_brand_id' => 'required',
            'model' => 'required|string',
            'device' => 'required',
        ]);

      if($this->ad){
        $computer = Computer::create([
            'computer_brand_id' => $request->computer_brand_id,
            'device' => $request->device,
            'ad_id' => $this->ad->id,
            'model' => $request->model,
        ]);
        return $computer->ad;
      }
    }

    public function computer_item($request){
        $request->validate([
            'computer_accessory_id' => 'required',
        ]);

      if($this->ad){
        $computer_accessory = ComputerItem::create([
            'computer_accessory_id' => $request->computer_accessory_id,
            'ad_id' => $this->ad->id,
        ]);
        return $computer_accessory->ad;
      }
    }
    
    public function audio_type($request){
        $request->validate([
            'audio_type_id' => 'required',
        ]);

      if($this->ad){
        $audio_type = AudioItem::create([
            'audio_type_id' => $request->audio_type_id,
            'ad_id' => $this->ad->id,
        ]);
        return $audio_type->ad;
      }

    }

    public function camera_type($request){
        $request->validate([
            'camera_type_id' => 'required',
            'camera_brand_id' => 'required',
        ]);

      if($this->ad){
        $camera_type = CameraItem::create([
            'camera_type_id' => $request->camera_type_id,
            'camera_brand_id' => $request->camera_brand_id,
            'ad_id' => $this->ad->id,
        ]);
        return $camera_type->ad;
      }

    }  

    public function tv($request){
      $request->validate([
          'tv_brand_id' => 'required',
          'model' => 'required|string',
      ]);

    if($this->ad){
      $tv = Tv::create([
          'tv_brand_id' => $request->tv_brand_id,
          'ad_id' => $this->ad->id,
          'model' => $request->model,
      ]);
      return $tv->ad;
    }
  }

  public function tv_item($request){
    $request->validate([
        'item_type' => 'required',
    ]);

  if($this->ad){
    $tv_accessory = TvItem::create([
        'item_type' => $request->item_type,
        'ad_id' => $this->ad->id,
    ]);
    return $tv_accessory->ad;
  }
}

public function beauty($request){
  $request->validate([
      'item_type' => 'required',
  ]);

if($this->ad){
  $beauty = Beauty::create([
      'item_type' => $request->item_type,
      'ad_id' => $this->ad->id,
  ]);
  return $beauty->ad;
}
}

public function clothing($request){
  $request->validate([
      'gender' => 'required',
  ]);

if($this->ad){
  $clothing = Clothing::create([
      'gender' => $request->gender,
      'ad_id' => $this->ad->id,
  ]);
  return $clothing->ad;
}
}

public function footwear($request){
  $request->validate([
      'gender' => 'required',
  ]);

if($this->ad){
  $footwear = Footwear::create([
      'gender' => $request->gender,
      'ad_id' => $this->ad->id,
  ]);
  return $footwear->ad;
}
}

public function electricity($request){
  $request->validate([
      'item_type' => 'required',
  ]);

if($this->ad){
  $elect = Electricity::create([
      'item_type' => $request->item_type,
      'ad_id' => $this->ad->id,
  ]);
  return $elect->ad;
}
}

public function home_ap($request){
  $request->validate([
      'item_type' => 'required',
  ]);

if($this->ad){
  $home = HomeAp::create([
      'item_type' => $request->item_type,
      'ad_id' => $this->ad->id,
  ]);
  return $home->ad;
}
}

public function furniture($request){
  $request->validate([
      'furniture_type' => 'required',
  ]);

if($this->ad){
  $furniture = Furniture::create([
      'furniture_type' => $request->furniture_type,
      'ad_id' => $this->ad->id,
  ]);
  return $furniture->ad;
}
}
}

<?php


namespace App\Http\Repositories;

use App\Ad;
use App\Tv;
use App\Beauty;
use App\HomeAp;
use App\TvItem;
use App\Clothing;
use App\Computer;
use App\Footwear;
use App\AudioItem;
use App\Furniture;
use App\CameraItem;
use App\Electricity;
use App\MobilePhone;
use App\ComputerItem;
use App\Http\Repositories\ShowAdRepository;

class ShowAdSubRepository extends ShowAdRepository {
    
/**
 * display ads sub repository
 * @param mixed
 */
    public function mobile_phone(){
      if($this->ad){
        $item = MobilePhone::where('ad_id', $this->ad->id)->with(['mobile_model', 'mobile_brand'])->first();
          return ['ad' => $this->ad, 'item' => $item];
      }
    }

    public function computer(){
      if($this->ad){
        $item = Computer::where('ad_id', $this->ad->id)->with('computer_brand')->first();
          return ['ad' => $this->ad, 'item' => $item];
      }
    }

    public function computer_item(){

      if($this->ad){
        $item = ComputerItem::where('ad_id', $this->ad->id)->with('computer_accessory')->first();
          return ['ad' => $this->ad, 'item' => $item];
      }
    }

    public function audio_item(){

      if($this->ad){
        $item = AudioItem::where('ad_id', $this->ad->id)->with('audio_type')->first();
          return ['ad' => $this->ad, 'item' => $item];
      }

    }

    public function camera_item(){

      if($this->ad){
        $item = CameraItem::where('ad_id', $this->ad->id)->with(['camera_type', 'camera_brand'])->first();
          return ['ad' => $this->ad, 'item' => $item];
      }

    }

    public function tv(){

    if($this->ad){
      $item = Tv::where('ad_id', $this->ad->id)->with('tv_brand')->first();
        return ['ad' => $this->ad, 'item' => $item];
    }
  }

  public function tv_item(){

  if($this->ad){
    $item = TvItem::where('ad_id', $this->ad->id)->first();
      return ['ad' => $this->ad, 'item' => $item];
  }
}

public function beauty(){

if($this->ad){
  $item = Beauty::where('ad_id', $this->ad->id)->first();
    return ['ad' => $this->ad, 'item' => $item];
}
}

public function clothing(){

if($this->ad){
  $item = Clothing::where('ad_id', $this->ad->id)->first();
    return ['ad' => $this->ad, 'item' => $item];
}
}

public function footwear(){

if($this->ad){
  $item = Footwear::where('ad_id', $this->ad->id)->first();
    return ['ad' => $this->ad, 'item' => $item];
}
}

public function electricity(){

if($this->ad){
  $item = Electricity::where('ad_id', $this->ad->id)->first();
    return ['ad' => $this->ad, 'item' => $item];
}
}

public function home_ap(){

if($this->ad){
  $item = HomeAp::where('ad_id', $this->ad->id)->first();
    return ['ad' => $this->ad, 'item' => $item];
}
}

public function furniture(){

if($this->ad){
  $item = Furniture::where('ad_id', $this->ad->id)->first();
    return ['ad' => $this->ad, 'item' => $item];
}
}
}

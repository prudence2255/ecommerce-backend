<?php

use Illuminate\Database\Seeder;
use App\Ad;

class AdSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     public function ad(){
         
     }
    public function run()
    {
        factory(App\Ad::class, 1000)->create()->each(function ($ad) {
            switch ($ad->category) {
                case 'Mobile Phones':
                    factory(App\MobilePhone::class)->create(['ad_id' => $ad->id]);
                    break;
                case 'Computers & Tablets':
                    factory(App\Computer::class)->create(['ad_id' => $ad->id]);
                     break;
                case 'Computer Accessories':  
                    factory(App\ComputerItem::class)->create(['ad_id' => $ad->id]);
                    break; 
                case 'Audio & Mp3':  
                    factory(App\AudioItem::class)->create(['ad_id' => $ad->id]);
                    break;  
                 case 'Tvs':  
                    factory(App\Tv::class)->create(['ad_id' => $ad->id]);
                     break; 
                case 'Cameras & Camcorders':  
                    factory(App\CameraItem::class)->create(['ad_id' => $ad->id]);
                    break;
                 case 'Tv & Video Accessories':  
                    factory(App\Tv::class)->create(['ad_id' => $ad->id]);
                    break;   
                case 'Beauty Products':  
                    factory(App\Beauty::class)->create(['ad_id' => $ad->id]);
                    break;
                 case 'Clothing & Fashion':  
                    factory(App\Clothing::class)->create(['ad_id' => $ad->id]);
                    break;  
                            
                case 'Shoes & Footwear':  
                    factory(App\Footwear::class)->create(['ad_id' => $ad->id]);
                     break;  
                case 'Furniture':  
                    factory(App\Furniture::class)->create(['ad_id' => $ad->id]);
                     break; 
                 case 'Electricity, AC & Bathroom':  
                    factory(App\Electricity::class)->create(['ad_id' => $ad->id]);
                    break; 
                case 'Home Appliances':  
                    factory(App\HomeAp::class)->create(['ad_id' => $ad->id]);
                    break; 
                case 'Houses':  
                    factory(App\House::class)->create(['ad_id' => $ad->id]);
                    break;
                case 'Commercial Property':  
                    factory(App\CommercialProp::class)->create(['ad_id' => $ad->id]);
                    break;
               
                 case 'Land':  
                    factory(App\Land::class)->create(['ad_id' => $ad->id]);
                    break;  
                 case 'Apartments':  
                    factory(App\Apartment::class)->create(['ad_id' => $ad->id]);
                    break;  
                case 'Trade Services':  
                    factory(App\Trade::class)->create(['ad_id' => $ad->id]);
                    break;  
                case 'Events & Hospitality':  
                    factory(App\Event::class)->create(['ad_id' => $ad->id]);
                    break;  
                 case 'Domestic & Personal Services':  
                    factory(App\Domestic::class)->create(['ad_id' => $ad->id]);
                    break;  
                case 'Health & Lifestyle':  
                    factory(App\Health::class)->create(['ad_id' => $ad->id]);
                    break; 
                case 'Cars':  
                    factory(App\Car::class)->create(['ad_id' => $ad->id]);
                     break; 
                 case 'Motorbikes & Scooters':  
                    factory(App\Motor::class)->create(['ad_id' => $ad->id]);
                    break; 
                case 'Auto Parts & Accessories':  
                    factory(App\Part::class)->create(['ad_id' => $ad->id]);
                     break;             
                default:
                   // $this->ad = $main;
                    break;
            }
        });
        
    }
}

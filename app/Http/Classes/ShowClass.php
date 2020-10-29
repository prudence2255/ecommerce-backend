<?php

namespace App\Http\Classes;

use Illuminate\Support\Facades\DB;
use App\Http\Classes\ShowAdSubClass;

class ShowClass {

    public $ad;

    public function show_data($item){
        $requestAll = $item;
       
        $categoryType = new ShowAdSubClass;
        DB::transaction(function () use ($requestAll, $categoryType){
            $main = $categoryType->main_data($requestAll);
             switch ($requestAll->category) {
            case 'Mobile Phones':
                 $this->ad = $categoryType->mobile_phone();  
                break;
            case 'Computers & Tablets':
                $this->ad = $categoryType->computer();
                 break;
            case 'Computer Accessories':  
                $this->ad = $categoryType->computer_item();
                break; 
            case 'Audio & Mp3':  
                $this->ad = $categoryType->audio_type();
                break;  
             case 'Tvs':  
                 $this->ad = $categoryType->tv();
                 break; 
            case 'Cameras & Camcorders':  
                $this->ad = $categoryType->camera_type();
                break;
             case 'Tv & Video Accessories':  
                $this->ad = $categoryType->tv_item();
                break;   
            case 'Beauty Products':  
                 $this->ad = $categoryType->beauty();
                break;
             case 'Clothing & Fashion':  
                $this->ad = $categoryType->clothing();
                break;  
                        
            case 'Shoes & Footwear':  
                 $this->ad = $categoryType->footwear();
                 break;  
            case 'Furniture':  
                $this->ad = $categoryType->furniture();
                 break; 
             case 'Electricity, AC & Bathroom':  
                $this->ad = $categoryType->electricity();
                break; 
            case 'Home Appliances':  
                $this->ad = $categoryType->home_ap();
                break; 
            case 'Houses':  
                $this->ad = $categoryType->house();
                break;
            case 'Commercial Property':  
                $this->ad = $categoryType->commercial_prop();
                break;
            case 'Home Appliances':  
                $this->ad = $categoryType->home_ap();
                break;
             case 'Land':  
                $this->ad = $categoryType->land();
                break;  
             case 'Apartments':  
                $this->ad = $categoryType->apartment();
                break;  
            case 'Trade Services':  
                 $this->ad = $categoryType->trade();
                break;  
            case 'Events & Hospitality':  
                $this->ad = $categoryType->event();
                break;  
             case 'Domestic & Personal Services':  
                 $this->ad = $categoryType->domestic();
                break;  
            case 'Health & Lifestyle':  
                $this->ad = $categoryType->health();
                break; 
            case 'Cars':  
                 $this->ad = $categoryType->car();
                 break; 
             case 'Motorbikes & Scooters':  
                $this->ad = $categoryType->motor();
                break; 
            case 'Auto Parts & Accessories':  
                $this->ad = $categoryType->auto_part();
                 break;             
            default:
                $this->ad = $main;
                break;
        }
        });
        return $this->ad;  
    }
}
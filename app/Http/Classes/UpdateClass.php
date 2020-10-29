<?php

namespace App\Http\Classes;

use Illuminate\Support\Facades\DB;
use App\Http\Classes\UpdateSubCategory;

class UpdateClass {

    public $ad;

    public function update_data($request, $item){
        $requestAll = $request;
        $request_data = $item;
        $categoryType = new UpdateSubCategory;
        DB::transaction(function () use ($requestAll, $categoryType, $request_data){
            $request_data->slug = null;
            $main = $categoryType->main_data($requestAll, $request_data);
             switch ($requestAll->category) {
            case 'Mobile Phones':
                 $this->ad = $categoryType->mobile_phone($requestAll);  
                break;
            case 'Computers & Tablets':
                $this->ad = $categoryType->computer($requestAll);
                 break;
            case 'Computer Accessories':  
                $this->ad = $categoryType->computer_item($requestAll);
                break; 
            case 'Audio & Mp3':  
                $this->ad = $categoryType->audio_type($requestAll);
                break;  
             case 'Tvs':  
                 $this->ad = $categoryType->tv($requestAll);
                 break; 
            case 'Cameras & Camcorders':  
                $this->ad = $categoryType->camera_type($requestAll);
                break;
             case 'Tv & Video Accessories':  
                $this->ad = $categoryType->tv_item($requestAll);
                break;   
            case 'Beauty Products':  
                 $this->ad = $categoryType->beauty($requestAll);
                break;
             case 'Clothing & Fashion':  
                $this->ad = $categoryType->clothing($requestAll);
                break;  
                        
            case 'Shoes & Footwear':  
                 $this->ad = $categoryType->footwear($requestAll);
                 break;  
            case 'Furniture':  
                $this->ad = $categoryType->furniture($requestAll);
                 break; 
             case 'Electricity, AC & Bathroom':  
                $this->ad = $categoryType->electricity($requestAll);
                break; 
            case 'Houses':  
                $this->ad = $categoryType->house($requestAll);
                break;
            case 'Commercial Property':  
                $this->ad = $categoryType->commercial_prop($requestAll);
                break;
            case 'Home Appliances':  
                $this->ad = $categoryType->home_ap($requestAll);
                break;
             case 'Land':  
                $this->ad = $categoryType->land($requestAll);
                break;  
             case 'Apartments':  
                $this->ad = $categoryType->apartment($requestAll);
                break;  
            case 'Trade Services':  
                 $this->ad = $categoryType->trade($requestAll);
                break;  
            case 'Events & Hospitality':  
                $this->ad = $categoryType->event($requestAll);
                break;  
             case 'Domestic & Personal Services':  
                 $this->ad = $categoryType->domestic($requestAll);
                break;  
            case 'Health & Lifestyle':  
                $this->ad = $categoryType->health($requestAll);
                break; 
            case 'Cars':  
                 $this->ad = $categoryType->car($requestAll);
                 break; 
             case 'Motorbikes & Scooters':  
                $this->ad = $categoryType->motor($requestAll);
                break; 
            case 'Auto Parts & Accessories':  
                $this->ad = $categoryType->auto_part($requestAll);
                 break;             
            default:
                $this->ad = $main;
                break;
        }
        });
        return $this->ad;  
    }
}
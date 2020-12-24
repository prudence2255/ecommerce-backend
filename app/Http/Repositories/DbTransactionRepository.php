<?php
namespace App\Http\Repositories;
use Illuminate\Support\Facades\DB;


class DbTransactionRepository {

    protected $ad;

    protected $data;

    protected $categoryType;

    public function transaction($data, $categoryType) {
        $this->data = $data;
        $this->categoryType = $categoryType;

        DB::transaction(function () {
            $main = $this->categoryType->main_data();
             switch ($this->data->category) {
            case 'Mobile Phones':
                 $this->ad = $this->categoryType->mobile_phone();
                break;
            case 'Computers & Tablets':
                $this->ad = $this->categoryType->computer();
                 break;
            case 'Computer Accessories':
                $this->ad = $this->categoryType->computer_item();
                break;
            case 'Audio & Mp3':
                $this->ad = $this->categoryType->audio_item();
                break;
             case 'Tvs':
                 $this->ad = $this->categoryType->tv();
                 break;
            case 'Cameras & Camcorders':
                $this->ad = $this->categoryType->camera_item();
                break;
             case 'Tv & Video Accessories':
                $this->ad = $this->categoryType->tv_item();
                break;
            case 'Beauty Products':
                 $this->ad = $this->categoryType->beauty();
                break;
             case 'Clothing & Fashion':
                $this->ad = $this->categoryType->clothing();
                break;

            case 'Shoes & Footwear':
                 $this->ad = $this->categoryType->footwear();
                 break;
            case 'Furniture':
                $this->ad = $this->categoryType->furniture();
                 break;
             case 'Electricity, AC & Bathroom':
                $this->ad = $this->categoryType->electricity();
                break;
            case 'Houses':
                $this->ad = $this->categoryType->house();
                break;
            case 'Commercial Property':
                $this->ad = $this->categoryType->commercial_prop();
                break;
            case 'Home Appliances':
                $this->ad = $this->categoryType->home_ap();
                break;
             case 'Land':
                $this->ad = $this->categoryType->land();
                break;
             case 'Apartments':
                $this->ad = $this->categoryType->apartment();
                break;
            case 'Trade Services':
                 $this->ad = $this->categoryType->trade();
                break;
            case 'Events & Hospitality':
                $this->ad = $this->categoryType->event();
                break;
             case 'Domestic & Personal Services':
                 $this->ad = $this->categoryType->domestic();
                break;
            case 'Health & Lifestyle':
                $this->ad = $this->categoryType->health();
                break;
            case 'Cars':
                 $this->ad = $this->categoryType->car();
                 break;
             case 'Motorbikes & Scooters':
                $this->ad = $this->categoryType->motor();
                break;
            case 'Auto Parts & Accessories':
                $this->ad = $this->categoryType->auto_part();
                 break;
            default:
                $this->ad = $main;
                break;
        }
        });

        return $this->ad;
    }
}

<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Category;
use App\Location;
use Illuminate\Http\Request;
use App\Http\Traits\OptionTrait;
use App\Http\Classes\CategoryType;
use Illuminate\Support\Facades\DB;
use Image;


class AdController extends Controller
{
    use OptionTrait;

    public $ad;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $requestAll = $request;
            $categoryType = new CategoryType();
            DB::transaction(function () use ($requestAll, $categoryType){
                $categoryType->main_data($requestAll);
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
                     $this->ad = $categoryType->ceauty($requestAll);
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
                case 'Home Appliances':  
                    $this->ad = $categoryType->home_ap($requestAll);
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
                default:
                    $this->ad = $categoryType->main_data($requestAll);
                    break;
            }
            });
           return response()->json($this->ad);         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        //
    }

    public function category_location(){
        $categories = Category::all();
        $locations = Location::all();
        return response()->json([
            'categories' => $this->option_transForm($categories, 'name', 'parent_id'),
            'locations' => $this->option_transform($locations, 'name', 'parent_id'),
        ]);
    }

public function create_image($requestPath, $path, $width, $height){
        $img = Image::make($requestPath)->resize($width, $height, function($constraint){
            $constraint->aspectRatio();
        });
        $img->save($path);
    } 

 public function images(Request $request){

    $request->validate([
        'photo' =>  'required|mimes:jpeg,jpg,png'
    ]);
     $email = $request->user()->email; 
    $image = $request->photo;
    $imageFullName = $image->getClientOriginalName();
    $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
    $imageExt = $image->getClientOriginalExtension();

    $xs = $imageName.$email.'xs'.time().'.'.$imageExt;
    $sm = $imageName.$email.'sm'.time().'.'.$imageExt;
    $md = $imageName.$email.'md'.time().'.'.$imageExt;
    $lg = $imageName.$email.'lg'.time().'.'.$imageExt;

    $xsmall = public_path('storage/photos/'.$xs);
    $small = public_path('storage/photos/'.$sm);
    $medium = public_path('storage/photos/'.$md);
    $large = public_path('storage/photos/'.$lg);
    
    
    $this->create_image(
        $image->getRealPath(), $xsmall, 300, 150
    );
    $this->create_image(
        $image->getRealPath(), $small, 500, 315
    );
    $this->create_image(
        $image->getRealPath(), $medium, 768, 415
    );
    $this->create_image(
        $image->getRealPath(), $large, 1200, 700
    );
    

    return response([
        'data' => [
            'xsmall' => url('storage/photos/'.$xs),
            'small' => url('storage/photos/'.$sm),
            'medium' => url('storage/photos/'.$md),
           'large' =>  url('storage/photos/'.$lg),
        ],
         'message' => 'Image uploaded successfully',
        ], 200);
 }  
 
 
}

<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Category;
use App\Location;
use Illuminate\Http\Request;
use App\Http\Traits\OptionTrait;
use App\Http\Classes\StoreClass;
use App\Http\Classes\UpdateClass;
use App\Http\Classes\ShowClass;
use Illuminate\Support\Facades\DB;
use Image;


class AdController extends Controller
{
    use OptionTrait;
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
        $data = new StoreClass;
        $results = $data->store_data($request);
       
        return response()->json($results);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        $data = new ShowClass;
        $results = $data->show_data($ad);
        $ad->child_category;
         $ad->child_location;
         $ad->parent_location;
         $ad->parent_category;
        $ad->customer;
        
        return response()->json($results);
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
        $ad->slug = null;
        $data = new UpdateClass;
        $results = $data->update_data($request, $ad);

        return response()->json($results);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        $ad->delete_images();
        $ad->delete();
        return response()->json(['message' => 'Ad deleted successfully'], 200);
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
        'photo' =>  'required|mimes:jpeg,jpg,png,jfif'
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
 
 //display specific user resource

 public function customer_ads(Request $request){
     $ads = Ad::where('customer_id', $request->user()->id)->orderBy('updated_at', 'DESC')->paginate(15);

     return response()->json($ads);
 }
}

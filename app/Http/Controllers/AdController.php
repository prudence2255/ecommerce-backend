<?php

namespace App\Http\Controllers;

use Image;
use App\Ad;
use App\Category;
use App\Location;
use Illuminate\Http\Request;
use App\Http\Traits\OptionTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Repositories\ShowRepository;
use App\Http\Repositories\ImageRepository;
use App\Http\Repositories\StoreRepository;
use App\Http\Repositories\UpdateRepository;


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

    public function deleteItems() {
        $items = Ad::where('category', 'Mobile Phones')->get();
        $items->map(function($item){
            if(!$item->mobile_phone){
                $item->delete();
            }
        });
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StoreRepository $storeRepository)
    {
        $results = $storeRepository->store_data($request);

        return response()->json($results);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad, ShowRepository $showRepository)
    {

        $results = $showRepository->show_data($ad);
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
    public function update(Request $request, Ad $ad, UpdateRepository $updateRepository)
    {
        $results = $updateRepository->update_data($ad, $request);

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

    /**
     *display listing of categories and locations
     */

    public function category_location(){
        $categories = Category::all();
        $locations = Location::all();
        return response()->json([
            'categories' => $this->option_transForm($categories, 'name', 'parent_id'),
            'locations' => $this->option_transform($locations, 'name', 'parent_id'),
        ]);
    }


    /**
     * store created ad images
     */

        public function images(Request $request, ImageRepository $imageRepository){

        $image = $imageRepository->process_image($request);
        return response(['data' => $image]);
     }

        //display customer ads

        public function customer_ads(Request $request){
         $ads = Ad::where('customer_id', $request->user()->id)->orderBy('updated_at', 'DESC')->paginate(15);

        return response()->json($ads);
 }
}

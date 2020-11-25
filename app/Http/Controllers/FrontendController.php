<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ad;
use App\Category;
use App\Location;
use App\Http\Traits\OptionTrait;
use Str;
use App\Http\Classes\ShowClass;

class FrontendController extends Controller
{
    use OptionTrait;

    public function main_categories(){
        $categories = Category::whereNull('parent_id')->get();
        return response()->json($categories);
    }


    public function main_locations(){
        $locations = Location::whereNull('parent_id')->get();
    }

    public function category_locations(){
        $categories = Category::withCount(['ads', 'adds'])->get();
        $locations = Location::withCount(['ads', 'adds'])->get();
        return response()->json([
            'categories' => $categories,
            'locations' => $locations, 
        ]);
    }


    public function all_ads(Request $request){
        $ads = Ad::whereNotNull('category');
      if($request->has('category')){
         $category = Category::where('slug', $request->category)->first();
         if($category->parent_id === null){
             $ads->where('main_category', $category->name);
         }else{
             $ads->where('category', $category->name);
         }
        }
    
      if($request->has('location')){
        $location = Location::where('slug', $request->location)->first();
        if($location->parent_id === null){
            $ads->where('main_location', $location->name);
        }else{
            $ads->where('location', $location->name);
        }
        }
        if($request->has('condition')){
        $ads->where('condition', $request->condition);  
        }
     
        if($request->has('min_price')){
         $ads->whereBetween('price', [$request->min_price, $request->max_price]);
        }

     if($request->has('search')){
        $request->validate([
            'search' => 'required|min:3|string'
       ]);
        $ads->where('title', 'LIKE', "%{$request->search}%");
        }
    if($request->has('order')){
        if($request->order === 'newest-on-top'){
            $ads->orderByDesc('updated_at');
        }
        if($request->order === 'oldest-on-top'){
            $ads->orderBy('updated_at');
        }
        if($request->order === 'low-to-high'){
            $ads->orderBy('price');
        }
        if($request->order === 'high-to-low'){
            $ads->orderByDesc('price', 'desc');
        }
    }
    if(!$request->order){
     $ads->orderByDesc('updated_at');
    }
    return response()->json($ads->paginate(20));
    }

    public function recent_ads(){
        $ads = Ad::orderBy('updated_at', 'DESC')->limit(10)->get();
        return response()->json($ads);
    }


    public function show(Ad $ad)
    {
        $data = new ShowClass;
        $results = $data->show_data($ad);
        $similar_ads = Ad::whereNotIn('slug', [$ad->slug])->where('category', $ad->category)->limit(12)
                        ->orderBy('updated_at', 'DESC')->get();
        $ad->child_category;
        $ad->child_location;
        $ad->parent_location;
        $ad->parent_category;
        $ad->customer;
        
        return response()->json(['ad' => $results, 'similar_ads' => $similar_ads]);
    }


}

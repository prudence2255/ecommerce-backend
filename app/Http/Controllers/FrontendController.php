<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ad;
use App\Category;
use App\Location;
use App\Http\Traits\OptionTrait;
use Str;
use App\Http\Repositories\ShowRepository;
use Illuminate\Pipeline\Pipeline;

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


    public function ads(Request $request){

        $ads = app(Pipeline::class)->send(Ad::query())
                        ->through([
                            \App\Http\QueryFilters\CategoryFilter::class,
                            \App\Http\QueryFilters\LocationFilter::class,
                            \App\Http\QueryFilters\ConditionFilter::class,
                            \App\Http\QueryFilters\OrderFilter::class,
                            \App\Http\QueryFilters\PriceFilter::class,
                            \App\Http\QueryFilters\SearchFilter::class,
                            \App\Http\QueryFilters\NotOrderFilter::class,
                        ])->thenReturn();

       return response()->json($ads->paginate(20));                         
    }


    
    public function recent_ads(){
        $ads = Ad::orderBy('updated_at', 'DESC')->limit(10)->get();
        return response()->json($ads);
    }


    public function show(Ad $ad, ShowRepository $showRepository)
    {
        $results = $showRepository->show_data($ad);
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

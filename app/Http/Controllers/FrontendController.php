<?php

namespace App\Http\Controllers;

use Str;
use App\Ad;
use App\Category;
use App\Location;
use App\MobileBrand;
use App\MobilePhone;
use Illuminate\Http\Request;
use App\Http\Traits\OptionTrait;
use Illuminate\Pipeline\Pipeline;
use App\Http\Repositories\BrandInterface;
use App\Http\Repositories\ShowRepository;


class FrontendController extends Controller
{

    use OptionTrait;


/**
 * get only categories with children
 */
    public function main_categories(){
        $categories = Category::whereNull('parent_id')->get();
        return response()->json($categories);
    }

    /**
     * get only locations with children
     */

    public function main_locations(){
        $locations = Location::whereNull('parent_id')->get();
    }

/**
 * get both locations and categories with their count
 */
    public function category_locations(){
        $categories = Category::withCount(['ads', 'adds'])->get();
        $locations = Location::withCount(['ads', 'adds'])->get();
        return response()->json([
            'categories' => $categories,
            'locations' => $locations,
        ]);
    }



    /**
     * display listing of all ads being filtered
     */
    public function ads(Request $request){

        $ads = Ad::filterBy(request()->all())->paginate(20);

        return response()->json($ads);

        if($request->has('mobile_brand')){
            $ads = Ad::whereHas('mobile_phone', function($query){
                $query->whereHas('mobile_brand', function($query){
                    $query->where('slug', request()->mobile_brand);
                });
            })->paginate(10);
        }
        return response()->json($ads);

    }


    /**
     * display recent ads
     */

    public function recent_ads(){
        $ads = Ad::orderBy('updated_at', 'DESC')->limit(10)->get();
        return response()->json($ads);
    }

    /**
     * display the specified ad
     */

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

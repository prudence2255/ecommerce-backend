<?php

namespace App\Http\Controllers;

use App\MobileBrand;
use Illuminate\Http\Request;
use App\Http\Traits\OptionTrait;

class MobileBrandController extends Controller
{
    use OptionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mobileBrands = MobileBrand::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $this->tag_transform($mobileBrands, 'brand')], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['brand' => 'required|unique:mobile_brands']);
        $mobileBrand = MobileBrand::create([
            'brand' => $request->brand,
        ]);

       if($mobileBrand){
           return response()->json(['data' => $mobileBrand], 200);
       } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MobileBrand  $mobileBrand
     * @return \Illuminate\Http\Response
     */
    public function show(MobileBrand $mobileBrand)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MobileBrand  $mobileBrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MobileBrand $mobileBrand)
    {
        $request->validate([
            'brand' => 'required|unique:mobile_brands,brand,'.$mobileBrand->id,
        ]);
       $mobileBrand->slug = null;
        $mobileBrand->update([
            'brand' => $request->brand,
            ]);
        return response()->json([
            'message' => 'mobileBrand updated successfully',
            'data' => $mobileBrand,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MobileBrand  $mobileBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(MobileBrand $mobileBrand)
    {
        if($mobileBrand->mobile_models){
            $mobileBrand->mobile_models()->delete();
        }

        if($mobileBrand->mobile_phones){
            $mobileBrand->mobile_phones->map(function($mobile){
                if($mobile->ad){
                    $mobile->ad()->delete();
                }
                
         });

            $mobileBrand->mobile_phones()->delete();
        }

        

        $mobileBrand->delete();
        return response()->json(['message' => 'mobile brand deleted successfully'], 200);
    }
}

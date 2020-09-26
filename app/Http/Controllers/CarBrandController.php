<?php

namespace App\Http\Controllers;

use App\CarBrand;
use Illuminate\Http\Request;
use App\Http\Traits\OptionTrait;

class CarBrandController extends Controller
{
    use OptionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $carBrands = CarBrand::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $this->tag_transform($carBrands,'brand')], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['brand' => 'required|unique:car_brands']);
        $carBrand = CarBrand::create([
            'brand' => $request->brand,
        ]);

       if($carBrand){
           return response()->json(['data' => $carBrand], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\carBrand  $carbrand
     * @return \Illuminate\Http\Response
     */
    public function show(CarBrand $carBrand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\carBrand  $carbrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarBrand $carBrand)
    {
        $request->validate([
            'brand' => 'required|unique:car_brands,brand,'.$carBrand->id,
        ]);
       $carBrand->slug = null;
        $carBrand->update([
            'brand' => $request->brand,
            ]);
        return response()->json([
            'message' => 'carBrand updated successfully',
            'data' => $carBrand,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\carBrand  $carbrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarBrand $carBrand)
    {
        if($carBrand->car_models){
            $carBrand->car_models()->delete();
        }
        $carBrand->delete();
        return response()->json(['message' => 'car brand deleted successfully'], 200);
    }
}

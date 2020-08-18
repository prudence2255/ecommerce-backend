<?php

namespace App\Http\Controllers;

use App\MotorBrand;
use Illuminate\Http\Request;

class MotorBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $motorBrands = MotorBrand::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $motorBrands], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['brand' => 'required|unique:motor_brands']);
        $motorBrand = MotorBrand::create([
            'brand' => $request->brand,
        ]);

       if($motorBrand){
           return response()->json(['data' => $motorBrand], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\motorBrand  $motorbrand
     * @return \Illuminate\Http\Response
     */
    public function show(MotorBrand $motorBrand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\motorBrand  $motorbrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MotorBrand $motorBrand)
    {
        $request->validate([
            'brand' => 'required|unique:motor_brands,brand,'.$motorBrand->id,
        ]);
       $motorBrand->slug = null;
        $motorBrand->update([
            'brand' => $request->brand,
            ]);
        return response()->json([
            'message' => 'motorBrand updated successfully',
            'data' => $motorBrand,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\motorBrand  $motorbrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(MotorBrand $motorBrand)
    {
        $motorBrand->delete();
        return response()->json(['message' => 'motor brand deleted successfully'], 200);
    }
}

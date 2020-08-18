<?php

namespace App\Http\Controllers;

use App\ComputerBrand;
use Illuminate\Http\Request;

class ComputerBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $computerBrands = ComputerBrand::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $computerBrands], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['brand' => 'required|unique:computer_brands']);
        $computerBrand = ComputerBrand::create([
            'brand' => $request->brand,
        ]);

       if($computerBrand){
           return response()->json(['data' => $computerBrand], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ComputerBrand  $computerbrand
     * @return \Illuminate\Http\Response
     */
    public function show(ComputerBrand $computerBrand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ComputerBrand  $computerbrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComputerBrand $computerBrand)
    {
        $request->validate([
            'brand' => 'required|unique:computer_brands,brand,'.$computerBrand->id,
        ]);
       $computerBrand->slug = null;
        $computerBrand->update([
            'brand' => $request->brand,
            ]);
        return response()->json([
            'message' => 'computerBrand updated successfully',
            'data' => $computerBrand,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ComputerBrand  $computerbrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComputerBrand $computerBrand)
    {
        // if($computerBrand->computers){
        //     $computerBrand->computers()->delete();
        // }
        $computerBrand->delete();
        return response()->json(['message' => 'computer brand deleted successfully'], 200);
    }
}

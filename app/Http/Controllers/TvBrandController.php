<?php

namespace App\Http\Controllers;

use App\TvBrand;
use Illuminate\Http\Request;

class TvBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $tvBrands = TvBrand::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $tvBrands], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['brand' => 'required|unique:tv_brands']);
        $tvBrand = TvBrand::create([
            'brand' => $request->brand,
        ]);

       if($tvBrand){
           return response()->json(['data' => $tvBrand], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TvBrand  $Tvbrand
     * @return \Illuminate\Http\Response
     */
    public function show(TvBrand $tvBrand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TvBrand  $Tvbrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TvBrand $tvBrand)
    {
        $request->validate([
            'brand' => 'required|unique:tv_brands,brand,'.$tvBrand->id,
        ]);
       $tvBrand->slug = null;
        $tvBrand->update([
            'brand' => $request->brand,
            ]);
        return response()->json([
            'message' => 'Updated successfully',
            'data' => $tvBrand,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TvBrand  $Tvbrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(TvBrand $tvBrand)
    {
        // if($TvBrand->Tvs){
        //     $TvBrand->Tvs()->delete();
        // }
        $tvBrand->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}

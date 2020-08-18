<?php

namespace App\Http\Controllers;

use App\CameraBrand;
use Illuminate\Http\Request;

class CameraCamcorderBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $cameraBrands = CameraBrand::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $cameraBrands], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['brand' => 'required|unique:camera_brands']);
        $cameraBrand = CameraBrand::create([
            'brand' => $request->brand,
        ]);

       if($cameraBrand){
           return response()->json(['data' => $cameraBrand], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CameraBrand  $CameraBrand
     * @return \Illuminate\Http\Response
     */
    public function show(CameraBrand $cameraBrand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CameraBrand  $CameraBrand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CameraBrand $cameraBrand)
    {
        $request->validate([
            'brand' => 'required|unique:camera_brands,brand,'.$cameraBrand->id,
        ]);
       $cameraBrand->slug = null;
        $cameraBrand->update([
            'brand' => $request->brand,
            ]);
        return response()->json([
            'message' => 'CameraBrand updated successfully',
            'data' => $cameraBrand,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CameraBrand  $CameraBrand
     * @return \Illuminate\Http\Response
     */
    public function destroy(CameraBrand $cameraBrand)
    {
        // if($CameraBrand->computers){
        //     $CameraBrand->computers()->delete();
        // }
        $cameraBrand->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}

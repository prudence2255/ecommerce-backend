<?php

namespace App\Http\Controllers;

use App\MobileFeature;
use Illuminate\Http\Request;

class MobileFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mobileFeatures = MobileFeature::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $mobileFeatures], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'feature' => 'required|unique:mobile_features',
        ]);
        $mobileFeature = MobileFeature::create([
            'feature' => $request->feature,
        ]);

       if($mobileFeature){
           return response()->json(['data' => $mobileFeature], 200);
       } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MobileFeature  $mobileFeature
     * @return \Illuminate\Http\Response
     */
    public function show(MobileFeature $mobileFeature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MobileFeature  $mobileFeature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MobileFeature $mobileFeature)
    {
        $request->validate([
            'feature' => 'required|unique:mobile_features,feature,'.$mobileFeature->id,
        ]);
       $mobileFeature->slug = null;
        $mobileFeature->update([
            'feature' => $request->feature,
            ]);
        return response()->json([
            'message' => 'mobileFeature updated successfully',
            'data' => $mobileFeature,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MobileFeature  $mobileFeature
     * @return \Illuminate\Http\Response
     */
    public function destroy(MobileFeature $mobileFeature)
    {
        $mobileFeature->delete();
        return response()->json(['message' => 'mobile Feature deleted successfully'], 200);
    }
}

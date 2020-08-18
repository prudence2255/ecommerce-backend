<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location = Location::with('children')->whereNull('parent_id')->get();

        return response()->json(['data' => $location], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function locations(){
        $locations = Location::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $locations], 200);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:locations']);
        $location = Location::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

       if($location){
           return response()->json(['data' => $location], 200);
       } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|unique:locations,name,'.$location->id,
        ]);
       $location->slug = null;
        $location->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            ]);
        return response()->json([
            'message' => 'location updated successfully',
            'data' => $location,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        if($location->children){
            $location->children()->delete();
        }
        $location->delete();
        return response()->json(['message' => 'location deleted successfully'], 200);
    }
}

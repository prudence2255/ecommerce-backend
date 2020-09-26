<?php

namespace App\Http\Controllers;

use App\HomeType;
use Illuminate\Http\Request;

class HomeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homeTypes = homeType::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $homeTypes], 200);
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
            'type' => 'required|unique:home_types',
            'parent_home_id' => 'required'
            ]);
        $homeType = HomeType::create([
            'type' => $request->type,
            'parent_home_id' => $request->parent_home_id,
        ]);

       if($homeType){
           return response()->json(['data' => $homeType], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\homeType  $homeType
     * @return \Illuminate\Http\Response
     */
    public function show(HomeType $homeType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\homeType  $homeType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeType $homeType)
    {
        $request->validate([
            'type' => 'required|unique:home_types,type,'.$homeType->id,
            'parent_home_id' => 'required'

        ]);
       $homeType->slug = null;
        $homeType->update([
            'type' => $request->type,
            'parent_home_id' => $request->parent_home_id,
            ]);
        return response()->json([
            'message' => 'homeType updated successfully',
            'data' => $homeType,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\homeType  $homeType
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeType $homeType)
    {
        $homeType->delete();
        return response()->json(['message' => 'home Type deleted successfully'], 200);
    }
    
}

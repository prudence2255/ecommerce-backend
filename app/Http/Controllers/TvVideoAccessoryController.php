<?php

namespace App\Http\Controllers;

use App\TvAccessory;
use Illuminate\Http\Request;

class TvVideoAccessoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $TvAccessories = TvAccessory::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $TvAccessories], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['type' => 'required|unique:tv_accessories']);
        $tvAccessory = TvAccessory::create([
            'type' => $request->type,
        ]);

       if($tvAccessory){
           return response()->json(['data' => $tvAccessory], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TvAccessory  $TvAccessory
     * @return \Illuminate\Http\Response
     */
    public function show(TvAccessory $TvAccessory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TvAccessory  $TvAccessory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TvAccessory $tvAccessory)
    {
        $request->validate([
            'type' => 'required|unique:tv_accessories,type,'.$tvAccessory->id,
        ]);
       $tvAccessory->slug = null;
        $tvAccessory->update([
            'type' => $request->type,
            ]);
        return response()->json([
            'message' => 'Updated successfully',
            'data' => $tvAccessory,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TvAccessory  $TvAccessory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TvAccessory $tvAccessory)
    {
        // if($TvAccessory->computers){
        //     $TvAccessory->computers()->delete();
        // }
        $tvAccessory->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}

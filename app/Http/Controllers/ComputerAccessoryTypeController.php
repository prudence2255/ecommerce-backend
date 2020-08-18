<?php

namespace App\Http\Controllers;

use App\ComputerAccessory;
use Illuminate\Http\Request;

class ComputerAccessoryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $computerAccessories = ComputerAccessory::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $computerAccessories], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['type' => 'required|unique:computer_accessories']);
        $computerAccessory = ComputerAccessory::create([
            'type' => $request->type,
        ]);

       if($computerAccessory){
           return response()->json(['data' => $computerAccessory], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ComputerAccessory  $computerAccessory
     * @return \Illuminate\Http\Response
     */
    public function show(ComputerAccessory $computerAccessory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ComputerAccessory  $computerAccessory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComputerAccessory $computerAccessory)
    {
        $request->validate([
            'type' => 'required|unique:computer_accessories,type,'.$computerAccessory->id,
        ]);
       $computerAccessory->slug = null;
        $computerAccessory->update([
            'type' => $request->type,
            ]);
        return response()->json([
            'message' => 'Updated successfully',
            'data' => $computerAccessory,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ComputerAccessory  $computerAccessory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComputerAccessory $computerAccessory)
    {
        // if($computerAccessory->computers){
        //     $computerAccessory->computers()->delete();
        // }
        $computerAccessory->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}

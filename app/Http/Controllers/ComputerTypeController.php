<?php

namespace App\Http\Controllers;

use App\ComputerType;
use Illuminate\Http\Request;

class ComputerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $computerTypes = ComputerType::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $computerTypes], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['type' => 'required|unique:computer_types']);
        $computerType = ComputerType::create([
            'type' => $request->type,
        ]);

       if($computerType){
           return response()->json(['data' => $computerType], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ComputerType  $computerType
     * @return \Illuminate\Http\Response
     */
    public function show(ComputerType $computerType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ComputerType  $computerType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComputerType $computerType)
    {
        $request->validate([
            'type' => 'required|unique:computer_types,type,'.$computerType->id,
        ]);
       $computerType->slug = null;
        $computerType->update([
            'type' => $request->type,
            ]);
        return response()->json([
            'message' => 'computerType updated successfully',
            'data' => $computerType,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ComputerType  $computerType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComputerType $computerType)
    {
        // if($computerType->computers){
        //     $computerType->computers()->delete();
        // }
        $computerType->delete();
        return response()->json(['message' => 'computer Type deleted successfully'], 200);
    }
    
}

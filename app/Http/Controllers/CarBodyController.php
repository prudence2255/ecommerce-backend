<?php

namespace App\Http\Controllers;

use App\CarBody;
use Illuminate\Http\Request;
use App\Http\Traits\OptionTrait;

class CarBodyController extends Controller
{
    use OptionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $carBodies = CarBody::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $this->option_transform($carBodies)], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['body' => 'required|unique:car_bodies']);
        $carBody = CarBody::create([
            'body' => $request->body,
        ]);

       if($carBody){
           return response()->json(['data' => $carBody], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\carBody  $carBody
     * @return \Illuminate\Http\Response
     */
    public function show(CarBody $carBody)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\carBody  $carBody
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarBody $carBody)
    {
        $request->validate([
            'body' => 'required|unique:car_bodies,body,'.$carBody->id,
        ]);
       $carBody->slug = null;
        $carBody->update([
            'body' => $request->body,
            ]);
        return response()->json([
            'message' => 'carBody updated successfully',
            'data' => $carBody,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\carBody  $carBody
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarBody $carBody)
    {

        $carBody->delete();
        return response()->json(['message' => 'computer body deleted successfully'], 200);
    }
}

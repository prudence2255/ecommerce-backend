<?php

namespace App\Http\Controllers;

use App\CarFuel;
use Illuminate\Http\Request;
use App\Http\Traits\OptionTrait;

class CarFuelController extends Controller
{
    use OptionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $carFuels = CarFuel::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $this->option_transform($carFuels)], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['fuel' => 'required|unique:car_fuels']);
        $carFuel = CarFuel::create([
            'fuel' => $request->fuel,
        ]);

       if($carFuel){
           return response()->json(['data' => $carFuel], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\carFuel  $carFuel
     * @return \Illuminate\Http\Response
     */
    public function show(CarFuel $carFuel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\carFuel  $carFuel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarFuel $carFuel)
    {
        $request->validate([
            'fuel' => 'required|unique:car_fuels,fuel,'.$carFuel->id,
        ]);
       $carFuel->slug = null;
        $carFuel->update([
            'fuel' => $request->fuel,
            ]);
        return response()->json([
            'message' => 'carFuel updated successfully',
            'data' => $carFuel,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\carFuel  $carFuel
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarFuel $carFuel)
    {
        $carFuel->delete();
        return response()->json(['message' => 'car fuel deleted successfully'], 200);
    }
}

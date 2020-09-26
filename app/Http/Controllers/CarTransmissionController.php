<?php

namespace App\Http\Controllers;

use App\CarTransmission;
use Illuminate\Http\Request;
use App\Http\Traits\OptionTrait;

class CarTransmissionController extends Controller
{
    use OptionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $carTransmissions = CarTransmission::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $this->option_transform($carTransmissions)], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['transmission' => 'required|unique:car_transmissions']);
        $carTransmission = CarTransmission::create([
            'transmission' => $request->transmission,
        ]);

       if($carTransmission){
           return response()->json(['data' => $carTransmission], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\carTransmission  $carTransmission
     * @return \Illuminate\Http\Response
     */
    public function show(CarTransmission $carTransmission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\carTransmission  $carTransmission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarTransmission $carTransmission)
    {
        $request->validate([
            'transmission' => 'required|unique:car_transmissions,transmission,'.$carTransmission->id,
        ]);
       $carTransmission->slug = null;
        $carTransmission->update([
            'transmission' => $request->transmission,
            ]);
        return response()->json([
            'message' => 'carTransmission updated successfully',
            'data' => $carTransmission,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\carTransmission  $carTransmission
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarTransmission $carTransmission)
    {
        $carTransmission->delete();
        return response()->json(['message' => 'computer transmission deleted successfully'], 200);
    }
}

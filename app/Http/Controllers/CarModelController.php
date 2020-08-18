<?php

namespace App\Http\Controllers;

use App\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $carModels = CarModel::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $carModels], 200);
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
            'model' => 'required|unique:car_models',
            'car_brand_id' => 'required'
            ]);
        $carModel = CarModel::create([
            'model' => $request->model,
            'car_brand_id' => $request->car_brand_id,

        ]);

       if($carModel){
           return response()->json(['data' => $carModel], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\carModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function show(CarModel $carModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\carModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarModel $carModel)
    {
        $request->validate([
            'model' => 'required|unique:car_models,model,'.$carModel->id,
            'car_brand_id' => 'required'
        ]);
       $carModel->slug = null;
        $carModel->update([
            'model' => $request->model,
            'car_brand_id' => $request->car_brand_id,
            ]);
        return response()->json([
            'message' => 'carModel updated successfully',
            'data' => $carModel,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\carModel  $carModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarModel $carModel)
    {
        // if($carModel->computers){
        //     $carModel->computers()->delete();
        // }
        $carModel->delete();
        return response()->json(['message' => 'computer model deleted successfully'], 200);
    }
}

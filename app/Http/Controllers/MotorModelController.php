<?php

namespace App\Http\Controllers;

use App\MotorModel;
use Illuminate\Http\Request;

class MotorModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $motorModels = MotorModel::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $motorModels], 200);
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
            'model' => 'required|unique:motor_models',
            'motor_brand_id' => 'required'
        ]);
        $motorModel = MotorModel::create([
            'model' => $request->model,
            'motor_brand_id' => $request->motor_brand_id,
        ]);

       if($motorModel){
           return response()->json(['data' => $motorModel], 200);
       } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\motorModel  $motorModel
     * @return \Illuminate\Http\Response
     */
    public function show(MotorModel $motorModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\motorModel  $motorModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MotorModel $motorModel)
    {
        $request->validate([
            'model' => 'required|unique:motor_models,model,'.$motorModel->id,
            'motor_brand_id' => 'required'
        ]);
       $motorModel->slug = null;
        $motorModel->update([
            'model' => $request->model,
            'motor_brand_id' => $request->motor_brand_id,
            ]);
        return response()->json([
            'message' => 'motorModel updated successfully',
            'data' => $motorModel,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\motorModel  $motorModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(MotorModel $motorModel)
    {
        if($motorModel->motor_phones){
            $motorModel->motor_phones()->delete();
        }
        $motorModel->delete();
        return response()->json(['message' => 'motor model deleted successfully'], 200);
    }
}

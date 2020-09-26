<?php

namespace App\Http\Controllers;

use App\MobileModel;
use Illuminate\Http\Request;
use App\Http\Traits\OptionTrait;

class MobileModelController extends Controller
{
    use OptionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $mobileModels = MobileModel::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $this->option_transform($mobileModels, 'model', 'mobile_brand_id')], 200);
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
            'model' => 'required|unique:mobile_models',
            'mobile_brand_id' => 'required'
        ]);
        $mobileModel = MobileModel::create([
            'model' => $request->model,
            'mobile_brand_id' => $request->mobile_brand_id,
        ]);

       if($mobileModel){
           return response()->json(['data' => $mobileModel], 200);
       } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MobileModel  $mobileModel
     * @return \Illuminate\Http\Response
     */
    public function show(MobileModel $mobileModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MobileModel  $mobileModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MobileModel $mobileModel)
    {
        $request->validate([
            'model' => 'required|unique:mobile_models,model,'.$mobileModel->id,
            'mobile_brand_id' => 'required'
        ]);
       $mobileModel->slug = null;
        $mobileModel->update([
            'model' => $request->model,
            'mobile_brand_id' => $request->mobile_brand_id,
            ]);
        return response()->json([
            'message' => 'mobileModel updated successfully',
            'data' => $mobileModel,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MobileModel  $mobileModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(MobileModel $mobileModel)
    {
        if($mobileModel->mobile_phones){
            $mobileModel->mobile_phones()->delete();
        }
        $mobileModel->delete();
        return response()->json(['message' => 'mobile model deleted successfully'], 200);
    }
}

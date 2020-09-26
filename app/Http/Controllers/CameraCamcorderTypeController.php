<?php

namespace App\Http\Controllers;

use App\CameraType;
use Illuminate\Http\Request;
use App\Http\Traits\OptionTrait;

class CameraCamcorderTypeController extends Controller
{
    use OptionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $cameraTypes = CameraType::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $this->tag_transform($cameraTypes, 'type')], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['type' => 'required|unique:camera_types']);
        $cameraType = CameraType::create([
            'type' => $request->type,
        ]);

       if($cameraType){
           return response()->json(['data' => $cameraType], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CameraType  $CameraType
     * @return \Illuminate\Http\Response
     */
    public function show(CameraType $cameraType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CameraType  $CameraType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CameraType $cameraType)
    {
        $request->validate([
            'type' => 'required|unique:camera_types,type,'.$cameraType->id,
        ]);
       $cameraType->slug = null;
        $cameraType->update([
            'type' => $request->type,
            ]);
        return response()->json([
            'message' => 'Updated successfully',
            'data' => $cameraType,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CameraType  $CameraType
     * @return \Illuminate\Http\Response
     */
    public function destroy(CameraType $cameraType)
    {
        $cameraType->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceTypes = ServiceType::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $serviceTypes], 200);
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
            'type' => 'required|unique:service_types',
            'parent_service_id' => 'required'
            ]);
        $serviceType = ServiceType::create([
            'type' => $request->type,
            'parent_service_id' => $request->parent_service_id,
        ]);

       if($serviceType){
           return response()->json(['data' => $serviceType], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\serviceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function show(serviceType $serviceType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\serviceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceType $serviceType)
    {
        $request->validate([
            'type' => 'required|unique:service_types,type,'.$serviceType->id,
            'parent_service_id' => 'required'

        ]);
       $serviceType->slug = null;
        $serviceType->update([
            'type' => $request->type,
            'parent_service_id' => $request->parent_service_id,
            ]);
        return response()->json([
            'message' => 'serviceType updated successfully',
            'data' => $serviceType,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\serviceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceType $serviceType)
    {
        $serviceType->delete();
        return response()->json(['message' => 'service Type deleted successfully'], 200);
    }
    
}

<?php

namespace App\Http\Controllers;

use App\ParentService;
use Illuminate\Http\Request;

class ParentServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parentServices = ParentService::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $parentServices], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['parent' => 'required|unique:parent_Services']);
        $parentService = ParentService::create([
            'parent' => $request->parent,
        ]);

       if($parentService){
           return response()->json(['data' => $parentService], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\parentService  $parentService
     * @return \Illuminate\Http\Response
     */
    public function show(ParentService $parentService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\parentService  $parentService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParentService $parentService)
    {
        $request->validate([
            'parent' => 'required|unique:parent_Services,parent,'.$parentService->id,
        ]);
       $parentService->slug = null;
        $parentService->update([
            'parent' => $request->parent,
            ]);
        return response()->json([
            'message' => 'parentService updated successfully',
            'data' => $parentService,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\parentService  $parentService
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParentService $parentService)
    {
        if($parentService->service_types){
            $parentService->service_types()->delete();
        }
        $parentService->delete();
        return response()->json(['message' => 'computer Type deleted successfully'], 200);
    }
    
}

<?php

namespace App\Http\Controllers;

use App\ParentHome;
use Illuminate\Http\Request;

class ParentHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parentHomes = ParentHome::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $parentHomes], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['parent' => 'required|unique:parent_homes']);
        $parentHome = ParentHome::create([
            'parent' => $request->parent,
        ]);

       if($parentHome){
           return response()->json(['data' => $parentHome], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\parentHome  $parentHome
     * @return \Illuminate\Http\Response
     */
    public function show(ParentHome $parentHome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\parentHome  $parentHome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParentHome $parentHome)
    {
        $request->validate([
            'parent' => 'required|unique:parent_homes,parent,'.$parentHome->id,
        ]);
       $parentHome->slug = null;
        $parentHome->update([
            'parent' => $request->parent,
            ]);
        return response()->json([
            'message' => 'parentHome updated successfully',
            'data' => $parentHome,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\parentHome  $parentHome
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParentHome $parentHome)
    {
        if($parentHome->home_types){
            $parentHome->home_types()->delete();
        }
        $parentHome->delete();
        return response()->json(['message' => 'computer Type deleted successfully'], 200);
    }
    
}

<?php

namespace App\Http\Controllers;

use App\AutoPart;
use Illuminate\Http\Request;
use App\Http\Traits\OptionTrait;

class AutoPartController extends Controller
{
    use OptionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $autoParts = AutoPart::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $this->tag_transform($autoParts, 'type')], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['type' => 'required|unique:auto_parts']);
        $autoPart = AutoPart::create([
            'type' => $request->type,
        ]);

       if($autoPart){
           return response()->json(['data' => $autoPart], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\autoPart  $autoPart
     * @return \Illuminate\Http\Response
     */
    public function show(AutoPart $autoPart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\autoPart  $autoPart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AutoPart $autoPart)
    {
        $request->validate([
            'type' => 'required|unique:auto_parts,type,'.$autoPart->id,
        ]);
       $autoPart->slug = null;
        $autoPart->update([
            'type' => $request->type,
            ]);
        return response()->json([
            'message' => 'autoPart updated successfully',
            'data' => $autoPart,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\autoPart  $autoPartype
     * @return \Illuminate\Http\Response
     */
    public function destroy(AutoPart $autoPart)
    {
        $autoPart->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}

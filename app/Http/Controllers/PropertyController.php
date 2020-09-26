<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;
use App\Http\Traits\OptionTrait;

class PropertyController extends Controller
{
    use OptionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $this->tag_transform($properties, 'type')], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['type' => 'required|unique:properties']);
        $property = Property::create([
            'type' => $request->type,
        ]);

       if($property){
           return response()->json(['data' => $property], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $Property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $Property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        $request->validate([
            'type' => 'required|unique:properties,type,'.$property->id,
        ]);
       $property->slug = null;
      if($property->update([
            'type' => $request->type,
            ])){
                return response()->json([
                    'message' => 'Property updated successfully',
                    'data' => $property,
                ],  200);
            }
      else{
          return  response(['not updated']);
      }  
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $Property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return response()->json(['message' => 'computer Type deleted successfully'], 200);
    }
    
}

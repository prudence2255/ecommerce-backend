<?php

namespace App\Http\Controllers;

use App\AudioType;
use Illuminate\Http\Request;
use App\Http\Traits\OptionTrait;

class AudioMp3TypeController extends Controller
{
    use OptionTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $audioTypes = AudioType::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $this->tag_transform($audioTypes,'type')], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['type' => 'required|unique:audio_types']);
        $audioType = AudioType::create([
            'type' => $request->type,
        ]);

       if($audioType){
           return response()->json(['data' => $audioType], 200);
       } 
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AudioType  $AudioType
     * @return \Illuminate\Http\Response
     */
    public function show(AudioType $audioType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AudioType  $AudioType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AudioType $audioType)
    {
        $request->validate([
            'type' => 'required|unique:audio_types,type,'.$audioType->id,
        ]);
       $audioType->slug = null;
        $audioType->update([
            'type' => $request->type,
            ]);
        return response()->json([
            'message' => 'AudioType updated successfully',
            'data' => $audioType,
        ],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AudioType  $AudioMp3Type
     * @return \Illuminate\Http\Response
     */
    public function destroy(AudioType $audioType)
    {
        $audioType->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}

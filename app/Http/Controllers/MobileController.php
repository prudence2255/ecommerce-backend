<?php

namespace App\Http\Controllers;

use App\Ad;
use App\MobileFeature;
use App\MobileBrand;
use App\MobileModel;
use App\MobilePhone;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class MobileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $status = 200;

    public function add_mobile_feature(Request $request){
        $validator = Validator::make($request->all(),
                     [
                     'feature' => 'required',
                     ]   
                    );
         if ($validator->fails()) {
                        return response([
                        'errors' => $validator->errors(),
                        'status' => 'error'
                    ], 201);
                 }           
         $feature = MobileFeature::create(['feature' => $request->feature]);
        return response([
            'message' => 'Feature created successfully',
            'data' => $feature,
            'status' => 'success',           
        ], $this->status);
    }

    public function add_mobile_model(Request $request){
        $validator = Validator::make($request->all(),
                     [
                     'model' => 'required',
                     'mobile_brand_id' => 'required'
                     ]   
                    );
         if ($validator->fails()) {
                        return response([
                        'errors' => $validator->errors(),
                        'status' => 'error'
                    ], 201);
                 }           
         $model = MobileModel::create(['model' => $request->model, 
                                    'mobile_brand_id' => $request->mobile_brand_id
                                    ]);
        return response([
            'message' => 'Model created successfully',
            'data' => $model,
            'status' => 'success',           
        ], $this->status);
    }

    public function add_mobile_brand(Request $request){
        $validator = Validator::make($request->all(),
                     [
                     'brand' => 'required',
                     ]   
                    );
         if ($validator->fails()) {
                        return response([
                        'errors' => $validator->errors(),
                        'status' => 'error'
                    ], 201);
                 }           
         $brand = MobileBrand::create(['brand' => $request->brand]);
        return response([
            'message' => 'Brand created successfully',
            'data' => $brand,
            'status' => 'success',           
        ], $this->status);
    }

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(),
        [
        'images' => 'required',
        'condition' => 'required',
        'title' => 'required',
        'description' => 'required',
        'price' => 'required',
        'mobile_brand_id' => 'required',
        'mobile_model_id' => 'required'
        ]   
       );
if ($validator->fails()) {
           return response([
           'errors' => $validator->errors(),
           'status' => 'error'
       ], 201);
    }           
    $ad= Ad::create([
        'title' => $request->title,
        'images' => $request->images,
        'condition' => $request->condition,
        'description' => $request->description,
        'price' => $request->price,
        'uid' => time(),
        'uuid' => (string) Str::uuid(),

        ]);
   
    $mobile = MobilePhone::create(['edition' => $request->edition,
                                    'ad_id' => $ad->id,
                                    'mobile_brand_id' => $request->mobile_brand_id,
                                    'mobile_model_id' => $request->mobile_model_id,
                                    ]);
    
   if($request->has('features')){
    $mobile->mobile_features()->attach($request->features);
   }
    return response([
    'message' => 'Ad created successfully',
    'data' => ['ad' => $ad, 'mobile' => $ad->mobile_phone,
                 'brand' => $mobile->mobile_brand,
                'model' => $mobile->mobile_model,
                'features' => $mobile->mobile_features
                ],
    'status' => 'success',           
    ], $this->status);
}
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function show(Ads $ads)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ads $ads)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ads $ads)
    {
        //
    }
}

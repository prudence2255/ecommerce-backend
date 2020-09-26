<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([], function() {
    Route::post('login', 'AdminController@login');
    Route::post('login/{provider}/callback', 'SocialLoginController@callback');
    Route::post('customer-login', 'CustomerController@login');
    Route::post('customer-register', 'CustomerController@register');
});

Route::group(['middleware' => 'auth:customer'], function() {
    Route::apiResource('customers', 'CustomerController');
    Route::get('login-customer', 'CustomerController@login_customer');
    Route::get('customer-logout', 'CustomerController@logout');   
});



Route::group(['middleware' => 'auth:customer'], function(){
    Route::apiResource('mobile-phones', 'MobileController');
    Route::apiResource('ads', 'AdController');
    Route::get('category-location', 'AdController@category_location');
    Route::post('image-upload', 'AdController@images');
});

Route::group([], function() {
    Route::apiResource('users', 'AdminController');
    Route::post('register', 'AdminController@register');
    Route::get('logout', 'AdminController@logout');
    Route::get('user-details', 'AdminController@user_details');
    Route::put('make-admin/{user}', 'AdminController@makeAdmin');    
});

Route::group([], function(){
    Route::apiResource('categories', 'CategoryController');
    Route::apiResource('locations', 'LocationController');
    Route::apiResource('mobile-brands', 'MobileBrandController');
    Route::apiResource('mobile-models', 'MobileModelController');
    Route::apiResource('computer-brands', 'ComputerBrandController');
    Route::apiResource('computer-types', 'ComputerTypeController');
    Route::apiResource('mobile-features', 'MobileFeatureController');
    Route::apiResource('audio-types', 'AudioMp3TypeController');
    Route::apiResource('camera-brands', 'CameraCamcorderBrandController');
    Route::apiResource('camera-types', 'CameraCamcorderTypeController');
    Route::apiResource('computer-accessories', 'ComputerAccessoryTypeController');
    Route::apiResource('tv-brands', 'TvBrandController');
    Route::apiResource('tv-accessories', 'TvVideoAccessoryController');
    Route::apiResource('car-bodies', 'CarBodyController');
    Route::apiResource('car-brands', 'CarBrandController');
    Route::apiResource('car-fuels', 'CarFuelController');
    Route::apiResource('car-models', 'CarModelController');
    Route::apiResource('car-transmissions', 'CarTransmissionController');
    Route::apiResource('motor-brands', 'MotorBrandController');
    Route::apiResource('motor-models', 'MotorModelController');
    Route::apiResource('auto-parts', 'AutoPartController');
    Route::apiResource('property', 'PropertyController');
    Route::apiResource('home-types', 'HomeTypeController');
    Route::apiResource('parent-homes', 'ParentHomeController');
    Route::apiResource('parent-services', 'ParentServiceController');
    Route::apiResource('service-types', 'ServiceTypeController');
    Route::get('all-categories', 'CategoryController@categories');
    Route::get('all-locations', 'LocationController@locations');
});
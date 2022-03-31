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



Route::get('vehicleStatus', 'App\Http\Controllers\API\VehicleStatusController@index');
Route::post('vehicleStatus', 'App\Http\Controllers\API\VehicleStatusController@store');

Route::get('location', 'App\Http\Controllers\API\LocationController@index');
Route::post('location', 'App\Http\Controllers\API\LocationController@store');


Route::get('deliveryStatus', 'App\Http\Controllers\API\DeliveryStatusController@index');
Route::post('deliveryStatus', 'App\Http\Controllers\API\DeliveryStatusController@store');

Route::get('orders', 'App\Http\Controllers\API\OrdersController@index');
Route::post('orders', 'App\Http\Controllers\API\OrdersController@store');

Route::get('vehicle', 'App\Http\Controllers\API\VehicleController@index');
Route::post('vehicle', 'App\Http\Controllers\API\VehicleController@store');

Route::get('delivery', 'App\Http\Controllers\API\DeliveryController@index');
Route::post('delivery', 'App\Http\Controllers\API\DeliveryController@store');

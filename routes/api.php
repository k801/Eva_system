<?php

use App\Http\Controllers\OrderController;
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
// Route::post('add_order','App\Http\Controllers\ProductController@add_order');

Route::get('picking_up',[OrderController::class,'index']);
Route::get('picking_up/edit',[OrderController::class,'picking_edit']);
Route::get('picking_up/delete',[OrderController::class,'picking_delete']);
Route::get('picking_up/store',[OrderController::class,'Pick_store']);

//tracking order
Route::get('picking_up/productTrackOrder',[OrderController::class,'productTrackOrder']);



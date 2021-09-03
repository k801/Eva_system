<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\RoleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth']], function() {
Route::resource('roles','App\Http\Controllers\RoleController');
Route::resource('users','App\Http\Controllers\UserController');
Route::resource('products','App\Http\Controllers\ProductController');
});


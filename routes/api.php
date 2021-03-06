<?php

use App\Http\Controllers\api\ApiCategoryController;
use App\Http\Controllers\api\ApiDeviceController;
use App\Http\Controllers\api\DataFetchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your api!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('realdata','\App\Http\Controllers\api\ApiDataController');

Route::resource('TempFakeDataCall','\App\Http\Controllers\api\TempDataController');
Route::get('fetchinterval/{timescale?}', [DataFetchController::class, 'show']);///{timescale?}', '\App\Http\Controllers\WelcomeController@dashboard_graphing')->name('dashboard.dashboard_graphing');
Route::resource('data','\App\Http\Controllers\api\DataController');
Route::resource('device',ApiDeviceController::class);
Route::resource('category',ApiCategoryController::class);

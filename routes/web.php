<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

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

//Default Laravel Welcome Page Load
Route::get('/', '\App\Http\Controllers\WelcomeController@index');

//Load Default Page after login
//Defaults to 1H parameter but from buttons can parse in new timescale parameter
Route::get('dashboard/{timescale?}', '\App\Http\Controllers\WelcomeController@dashboard_graphing')->name('dashboard.dashboard_graphing');

//Any other routes have to ve logged in to access


//Protect these routes with login
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    //Data Routes
    //!TOO MUCH DATA AT THE MOMENT
    //    Route::resource('data', DataController::class);

    //Device Routes
    Route::resource('devices', DeviceController::class);

    //Category Routes
    Route::resource('categories', CategoryController::class);
});

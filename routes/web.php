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
//Any other routes have to ve logged in to access
Route::get('/', '\App\Http\Controllers\WelcomeController@index');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    //Protect these routes with login

    //Load Default Page after login
    Route::get('dashboard', '\App\Http\Controllers\WelcomeController@dashboard_graphing')->name('dashboard');

    //Data Routes
    Route::resource('data', DataController::class);

    //Device Routes
    Route::resource('devices', DeviceController::class);

    //Category Routes
    Route::resource('categories', CategoryController::class);
});

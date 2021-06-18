<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DeviceController;
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
Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    //Logged in dashboard route
    Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');

    //Data Routes
    Route::resource('data', DataController::class)->name('index', 'admin.datas.index');

    //Device Routes
    Route::resource('devices', DeviceController::class);

    //Category Routes
    Route::resource('categories', CategoryController::class); #Uncomment after Kym does

    //User Routes
     // Route::resource('users', UserController::class);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

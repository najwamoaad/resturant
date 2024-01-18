<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Exceptions\MissingTokenException;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 
 

 
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
 
 

  Route::middleware('auth:sanctum')->group(function () {
    Route::get('/restaurant', [RestaurantController::class, 'index']);
    Route::get('/restaurants/{id}', [RestaurantController::class, 'show']);
    Route::get('/searchRestaurants', [RestaurantController::class, 'searchRestaurants']);
       Route::get('/ordersuser',[UserController::class,'ordersuser']);
        Route::post('/orders', [OrderController::class,'store']);
        Route::post('/logout',[UserController::class,'logout']);
       
    });

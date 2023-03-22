<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::post("categories",[CategoryController::class,"store"]);
    Route::put("categories/{id}",[CategoryController::class,"update"]);
    Route::delete("categories/{id}",[CategoryController::class,"destroy"]);

});

Route::post("login",[UserController::class,'login']);
Route::get("users",[UserController::class,"index"]);

//Categories routes
Route::get("categories",[CategoryController::class,"index"]);
Route::get("categories/{id}",[CategoryController::class,"show"]);
Route::get("search-categories/{name}",[CategoryController::class,"search"]);


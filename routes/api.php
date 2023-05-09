<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\MessageController;

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


});

//Auth routes
Route::post("login",[UserController::class,'login']);
Route::post("register",[UserController::class,'register']);

//User routes
Route::get("users",[UserController::class,"index"]);
Route::post("users",[UserController::class,"store"]);
Route::get("users/{id}",[UserController::class,"show"]);
Route::put("users/{id}", [UserController::class,"update"]);
Route::delete("users/{id}", [UserController::class,"destroy"]);

Route::get("userdetail/{id}",[UserDetailController::class,"show"]);

//Categories routes
Route::get("categories",[CategoryController::class,"index"]);
Route::get("categories/{id}",[CategoryController::class,"show"]);
Route::post("categories",[CategoryController::class,"store"]);
Route::put("categories/{id}",[CategoryController::class,"update"]);
Route::delete("categories/{id}",[CategoryController::class,"destroy"]);
Route::get("search-categories/{name}",[CategoryController::class,"search"]);

//City-District routes
Route::get("cities",[ProvinceController::class,"indexCity"]);
Route::get("districts/{id}",[ProvinceController::class,"indexDistrict"]);

//Messages routes
Route::get("messages",[MessageController::class,"index"]);
Route::post("messages",[MessageController::class,"store"]);
Route::delete("messages/{id}", [MessageController::class,"destroy"]);

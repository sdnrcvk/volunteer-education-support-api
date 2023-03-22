<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("categories",[CategoryController::class,"getAll"]);
Route::get("categories/{id}",[CategoryController::class,"getById"]);
Route::post("categories",[CategoryController::class,"add"]);
Route::put("categories/{id}",[CategoryController::class,"update"]);
Route::get("search-categories/{name}",[CategoryController::class,"search"]);
Route::delete("categories/{id}",[CategoryController::class,"delete"]);


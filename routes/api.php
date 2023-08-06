<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
//auth routes
Route::post('register', [AuthController::class, 'register'])->middleware('guest:sanctum');
Route::post('login', [AuthController::class, 'login'])->middleware('guest:sanctum');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
//post routes
Route::get('post/show', [PostController::class, 'show'])->middleware('auth:sanctum');
Route::post('post/store', [PostController::class, 'store'])->middleware('auth:sanctum');
Route::post('post/update', [PostController::class, 'update'])->middleware('auth:sanctum');
Route::post('post/destroy', [PostController::class, 'destroy'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

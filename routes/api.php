<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
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
Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('products/create', [ProductController::class, 'store']);
    Route::post('products/{product}/update', [ProductController::class, 'update']);
    Route::delete('products/{product}/delete', [ProductController::class, 'destroy']);

    // Route::post('users/create', [UserController::class, 'store']);
    // Route::post('users/{user}/update', [UserController::class, 'update']);
    // Route::delete('users/{user}/delete', [UserController::class, 'destroy']);
});

Route::get('products', [ProductController::class, 'index']);
Route::post('devices', [ProductController::class, 'addDevice']);
Route::post('contact', [ProductController::class, 'contact']);
Route::post('order', [ProductController::class, 'order']);
Route::get('initial', [ProductController::class, 'initial']);
Route::post('notification/send', [ProductController::class, 'sendNotification']);

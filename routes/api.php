<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'user'])->middleware('auth:sanctum');
    Route::put('/update', [UserController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/destroy', [UserController::class, 'destroy'])->middleware('auth:sanctum');
});

Route::get('/products', [ProductController::class, 'index']);

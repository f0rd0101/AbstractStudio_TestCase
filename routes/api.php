<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Auth Routes
 Route::post('/register',[AuthController::class,'register']);
 Route::post('/login', [AuthController::class, 'login']);
 Route::post('/logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');

//  UserData Routes
Route::get('/info',[DataController::class,'index'])->middleware('auth:sanctum');
Route::post('/info',[DataController::class,'store'])->middleware('auth:sanctum');




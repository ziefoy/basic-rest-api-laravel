<?php

use App\Http\Controllers\Api\AuthApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PegawaiApiController;


Route::post('/register', [AuthApiController::class,'register']);
Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/me', [AuthApiController::class, 'me']);
    Route::post('/logout', [AuthApiController::class, 'logout']);
    // Route untuk API Pegawai
    Route::apiResource('/pegawai', PegawaiApiController::class);
    // Route::get('/users', [AuthApiController::class, 'index']);
});


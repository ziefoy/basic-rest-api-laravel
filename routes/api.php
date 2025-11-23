<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PegawaiApiController;


// Route untuk API Pegawai
Route::apiResource('pegawai', PegawaiApiController::class);


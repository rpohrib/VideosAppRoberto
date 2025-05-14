<?php

use App\Http\Controllers\ApiMultimediaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('multimedia', ApiMultimediaController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

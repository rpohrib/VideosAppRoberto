<?php

use App\Http\Controllers\ApiMultimediaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/videos', [ApiMultimediaController::class, 'getVideos']);
Route::delete('/delete/video', [ApiMultimediaController::class, 'deleteVideo']);
Route::post('/login', [ApiMultimediaController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/upload/video', [ApiMultimediaController::class, 'storeVideo']);
Route::post('/upload/photo', [ApiMultimediaController::class, 'storePhoto']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

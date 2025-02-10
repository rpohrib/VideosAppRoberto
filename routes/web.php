<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideosController;

Route::get('/videos/{id}', [VideosController::class, 'show'])->name('videos.show');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/videos/manage', [VideosController::class, 'index'])->name('videos.manage');
    //Route::get('/videos/manage', [VideosController::class, 'index'])->name('videos.manage')->middleware('can:manage-videos');
});

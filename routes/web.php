<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\VideosManageController;

Route::get('/videos/{id}', [VideosController::class, 'show'])->name('videos.show');
//Route::get('/prova2', [VideosManageController::class, 'index'])->name('videos.index');
//Route::get('/videos/manage', [VideosManageController::class, 'index'])->name('videos.index');


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



   // Route::middleware(['auth', 'role:Video Manager'])->get('/videos/manage', [VideosManageController::class, 'index']);
    Route::get('/roberto2', [VideosManageController::class, 'index'])->name('videos.index')->middleware('role:Video Manager');
});

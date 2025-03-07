<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\VideosManageController;

Route::get('/videos/{id}', [VideosController::class, 'show'])->name('videos.show');
//Route::get('/prova2', [VideosManageController::class, 'index'])->name('videos.index');
//Route::get('/videos/manage', [VideosManageController::class, 'index'])->name('videos.index');

// Route for the index page, accessible to everyone
Route::get('/videos', [VideosController::class, 'index'])->name('videos.index');

// Routes for CRUD operations, accessible only to logged-in users with the 'Video Manager' role
//Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:Video Manager'])->group(function () {
    Route::get('/videosmanage', [VideosManageController::class, 'index'])->name('manage.index');
    Route::get('/videos/manage/create', [VideosManageController::class, 'create'])->name('manage.create');
    Route::post('/videos/manage', [VideosManageController::class, 'store'])->name('manage.store');
    Route::get('/videos/manage/{video}/edit', [VideosManageController::class, 'edit'])->name('manage.edit');
    Route::put('/videos/manage/{video}', [VideosManageController::class, 'update'])->name('manage.update');
    Route::delete('/videos/manage/{video}', [VideosManageController::class, 'destroy'])->name('manage.destroy');
//});

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
    //Route::get('/roberto2', [VideosManageController::class, 'index'])->name('videos.index')->middleware('role:Video Manager');
});

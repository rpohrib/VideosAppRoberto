<?php

use App\Http\Controllers\usersController;
use App\Http\Controllers\usersManageController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\VideosManageController;
use Illuminate\Support\Facades\Route;

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

    // Routes for managing users, accessible only to logged-in users with appropriate roles
//    Route::middleware(['auth', 'role:Super Admin|User Manager'])->group(function () {
        Route::get('/users/manage', [UsersManageController::class, 'index'])->name('users.manage.index');
        Route::get('/users/manage/create', [UsersManageController::class, 'create'])->name('users.manage.create');
        Route::post('/users/manage', [UsersManageController::class, 'store'])->name('users.manage.store');
        Route::get('/users/manage/{user}/edit', [UsersManageController::class, 'edit'])->name('users.manage.edit');
        Route::put('/users/manage/{user}', [UsersManageController::class, 'update'])->name('users.manage.update');
        Route::delete('/users/manage/{user}/delete', [UsersManageController::class, 'delete'])->name('users.manage.delete');
        Route::delete('/users/manage/{user}', [UsersManageController::class, 'destroy'])->name('users.manage.destroy');
//    });
    // Routes for index and show, accessible only to logged-in users
    Route::middleware(['auth'])->group(function () {
        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [UsersController::class, 'show'])->name('users.show');
    });

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

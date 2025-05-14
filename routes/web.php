<?php

use App\Http\Controllers\SeriesManageController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\usersManageController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\VideosManageController;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/videos/{id}', [VideosController::class, 'show'])->name('videos.show');
//Route::get('/prova2', [VideosManageController::class, 'index'])->name('videos.index');
//Route::get('/videos/manage', [VideosManageController::class, 'index'])->name('videos.index');


Route::resource('videos', VideosController::class)->middleware('auth');

// Route for the index page, accessible to everyone
Route::get('/videos', [VideosController::class, 'index'])->name('videos.index');

// Routes for CRUD operations, accessible only to logged-in users with the 'Video Manager' role
//Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:Video Manager'])->group(function () {
    Route::get('/videosmanage', [VideosManageController::class, 'index'])->name('manage.index');
    Route::get('/videos/manage/create', [VideosManageController::class, 'create'])->name('manage.create');
    Route::get('/videoscreate', [VideosController::class, 'create'])->name('videos.create');
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


Route::middleware(['auth'])->prefix('series/manage')->name('series.manage.')->group(function () {
    Route::get('/', [SeriesManageController::class, 'index'])->name('index'); // Manage index
    Route::get('/create', [SeriesManageController::class, 'create'])->name('create'); // Create form
    Route::post('/', [SeriesManageController::class, 'store'])->name('store'); // Store series
    Route::get('/{series}/edit', [SeriesManageController::class, 'edit'])->name('edit'); // Edit form
    Route::put('/{series}', [SeriesManageController::class, 'update'])->name('update'); // Update series
    Route::delete('/{series}', [SeriesManageController::class, 'destroy'])->name('destroy'); // Delete series
    Route::delete('/{series}/delete', [SeriesManageController::class, 'delete'])->name('delete');
});

// Public routes for index and show
Route::middleware(['auth'])->group(function () {
    Route::get('/series', [SeriesManageController::class, 'index'])->name('series.index'); // Public index
    Route::get('/series/{id}', [SeriesManageController::class, 'show'])->name('series.show'); // Public show
});

Route::get('/notifications', function () {
    $notifications = Notification::where('notifiable_id', Auth::id())
        ->where('notifiable_type', 'App\Models\User')
        ->get();

    return view('notifications', compact('notifications'));
})->name('notifications.index')->middleware('auth');

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

<?php

use App\Http\Controllers\UsersManageController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\VideosManageController;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/videos/{id}', [VideosController::class, 'show']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/manage/videos', [VideosManageController::class, 'index'])->middleware(['can:videos_manage_index'])
        ->name('manage.videos');
    Route::post('/manage/videos',[VideosManageController::class,'store'])->middleware(['can:videos_manage_add']);

    Route::delete('/manage/videos/{id}',[VideosManageController::class,'destroy']) ->middleware(['can:videos_manage_delete']);

    Route::post('/manage/users',[UsersManageController::class,'store'])->middleware(['can:users_manage_add']);

    Route::delete('/manage/users/{id}',[UsersManageController::class,'destroy'])->middleware(['can:users_manage_delete']);
    Route::get('/manage/users', [UsersManageController::class, 'index'])->middleware(['can:user_manage_index'])
        ->name('manage.users');
});

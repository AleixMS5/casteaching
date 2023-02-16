<?php

use App\Http\Controllers\UsersManageController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\VideosManageController;
use App\Http\Controllers\VideosManageVueController;
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
    Route::put('/manage/videos/{id}',[VideosManageController::class,'update']) ->middleware(['can:videos_manage_update']);
    Route::get('/manage/videos/{id}',[VideosManageController::class,'edit']) ->middleware(['can:videos_manage_edit']);


    Route::post('/manage/users',[UsersManageController::class,'store'])->middleware(['can:users_manage_add']);

    Route::delete('/manage/users/{id}',[UsersManageController::class,'destroy'])->middleware(['can:users_manage_delete']);
    Route::get('/manage/users', [UsersManageController::class, 'index'])->middleware(['can:user_manage_index'])
        ->name('manage.users');
    Route::put('/manage/users/{id}',[UsersManageController::class,'update'])->middleware(['can:users_manage_update']);
    Route::get('/manage/users/{id}',[UsersManageController::class,'edit'])->middleware(['can:users_manage_edit']);


    Route::get('vue/manage/videos', [VideosManageVueController::class, 'index'])->middleware(['can:videos_manage_index'])
        ->name('vue.manage.videos');
    Route::post('vue/manage/videos',[VideosManageVueController::class,'store'])->middleware(['can:videos_manage_add']);

    Route::delete('vue/manage/videos/{id}',[VideosManageVueController::class,'destroy']) ->middleware(['can:videos_manage_delete']);
    Route::put('vue/manage/videos/{id}',[VideosManageVueController::class,'update']) ->middleware(['can:videos_manage_update']);
    Route::get('vue/manage/videos/{id}',[VideosManageVueController::class,'edit']) ->middleware(['can:videos_manage_edit']);

});

Route::get('/casteaching_javascript',function (){
    return view('casteaching_javascript');
});

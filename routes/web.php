<?php

use App\Http\Controllers\VideosController;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/videos/{id}',[VideosController::class,'show']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/prova',function (){
    Video::create([
        'title'=> 'Ubuntu 101',
        'description'=>'',
        'url'=> 'https://youtu.be/w8j07_DBl_I',
        'published_at'=>Carbon::parse('December 13,2020 8:00pm'),
        'completed'=>false,
        'previous'=>null,
        'next'=>null,
        'series_id'=>1
    ]);
});

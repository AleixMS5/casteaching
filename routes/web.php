<?php

use App\Http\Controllers\SeriesManageController;
use App\Http\Controllers\UsersManageController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\VideosManageController;
use App\Http\Controllers\VideosManageVueController;
use GitHub\Sponsors\Client;
use Illuminate\Support\Facades\Route;
use Kanuu\Laravel\Facades\Kanuu;
use Laravel\Socialite\Facades\Socialite;


Route::get('/', [\App\Http\Controllers\LandingPageController::class,'show']);

Route::get('/videos/{id}', [VideosController::class, 'show']);


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/subscribe', function () {
        return redirect(route('kanuu.redirect',Auth::user()));
    })->name('subscribe');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/manage/series', [ SeriesManageController::class,'index'])->middleware(['can:series_manage_index'])
        ->name('manage.series');

    Route::post('/manage/series',[ SeriesManageController::class,'store' ])->middleware(['can:series_manage_store']);
    Route::delete('/manage/series/{id}',[ SeriesManageController::class,'destroy' ])->middleware(['can:series_manage_destroy']);
    Route::get('/manage/series/{id}',[ SeriesManageController::class,'edit' ])->middleware(['can:series_manage_edit']);
    Route::put('/manage/series/{id}',[ SeriesManageController::class,'update' ])->middleware(['can:series_manage_update']);


    Route::put('/manage/series/image/{id}',[ \App\Http\Controllers\SeriesImageManageController::class,'update' ])->middleware(['can:series_manage_update']);




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


Route::get('/github_sponsors', function () {
    $client = app(Client::class);
    dump($sponsors = $client->login('acacha')->sponsors());
    foreach ($sponsors as $sponsor) {
        dump($sponsor['avatarUrl']); // The sponsor's GitHub avatar url...
        dump($sponsor['name']); // The sponsor's GitHub name...
    }

    dump($sponsors = $client->login('driesvints')->sponsors());
    foreach ($sponsors as $sponsor) {
        dump($sponsor);
    }

    dd($client->login('acacha')->isSponsoredBy('acacha'));
});


Route::get('/auth/redirect',[\App\Http\Controllers\GithubAuthController::class,'redirect']


 );


Kanuu::redirectRoute()
    ->middleware('auth')
    ->name('kanuu.redirect');
Route::get('/auth/callback', [\App\Http\Controllers\GithubAuthController::class,'callback']);




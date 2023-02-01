<?php

use App\Http\Controllers\VideoApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::delete('/videos/{id}',[VideoApiController::class,'destroy'])->middleware(['can:videos_manage_delete']);
    Route::put('/videos/{id}',[VideoApiController::class,'update'])->middleware(['can:videos_manage_update']);
    Route::post('/videos',[VideoApiController::class,'store'])->middleware(['can:videos_manage_add']);
});
Route::get('/videos/{id}',[VideoApiController::class,'show']);

Route::get('/videos',[VideoApiController::class,'index']);

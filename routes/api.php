<?php

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
//
//Route::get('test',function ()
//{
//    dd('aaa');
//});

Route::post('register',[\App\Http\Controllers\api\AuthController::class,'register']);
Route::post('login',[\App\Http\Controllers\api\AuthController::class,'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('interviews',[\App\Http\Controllers\api\InterviewController::class,'index']);
    Route::get('interviews/show',[\App\Http\Controllers\api\InterviewController::class,'show']);
    Route::post('interviews/create',[\App\Http\Controllers\api\InterviewController::class,'create']);
    Route::patch('interviews',[\App\Http\Controllers\api\InterviewController::class,'update']);
    Route::delete('interviews',[\App\Http\Controllers\api\InterviewController::class,'delete']);
});

<?php

use App\Http\Controllers\App\AppAutoController;
use App\Http\Controllers\App\AppController;
use App\Http\Controllers\App\AppFriendController;
use App\Http\Controllers\App\AppMessageController;
use App\Http\Controllers\App\AppSendController;
use App\Http\Controllers\App\AppWebhookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group. Make something great!
|
*/
Route::prefix("app")->group(function(){
    Route::get("/",[AppController::class,"index"]);
    Route::get("create",[AppController::class,"create"]);
    Route::post("/",[AppController::class,"store"]);
    Route::prefix("{app_name}")->group(function(){
        Route::get("/",[AppController::class,"show"]);
        Route::get("webhook",[AppWebhookController::class,"index"]);
        Route::prefix("friend")->group(function(){
            Route::get("/",[AppFriendController::class,"index"]);
            Route::get("{friend_id}",[AppFriendController::class,"show"]);
        });
        Route::prefix("message")->group(function(){
            Route::get("/",[AppMessageController::class,"index"]);
            Route::get("{id}",[AppMessageController::class,"show"]);
        });
        Route::prefix("send")->group(function(){
            Route::get("/",[AppSendController::class,"index"]);
            Route::get("{id}",[AppSendController::class,"show"]);
        });
        Route::prefix("auto")->group(function(){
            Route::get("/",[AppAutoController::class,"index"]);
            Route::get("{id}",[AppAutoController::class,"show"]);
            Route::post("enable",[AppAutoController::class,"enable"]);
        });
    });
});
Route::get("news",[AppController::class,"index"]);
Route::get("message",[AppController::class,"index"]);


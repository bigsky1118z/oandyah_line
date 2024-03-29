<?php

use App\Http\Controllers\App\AppController;
use App\Http\Controllers\App\AppWebhookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebController;
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

Route::post("app/{app_name}/webhook",[AppWebhookController::class,"post"]);

// Route::prefix("{user_name}")->middleware("check_user_name")->group(function(){
    // Route::get("/",[WebController::class,"show"]);

    // Route::get("create",[AppController::class,"create"]);
    // Route::post("/",[AppController::class,"store"]);
    // Route::prefix("{app_name}")->group(function(){
    //     Route::get("/",[AppController::class,"show"]);
    //     Route::get("webhook",[AppWebhookController::class,"index"]);
    // });
// });
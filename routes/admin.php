<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
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

Route::prefix("admin")->group(function(){
    Route::get("/",[AdminController::class,"index"]);
    Route::get("redirect",[AdminController::class,"redirect"]);
    Route::prefix("user")->group(function(){
        Route::get("/",[AdminUserController::class,"index"]);
        Route::prefix("{user_id}")->group(function(){
            Route::get("/",[AdminUserController::class,"create"]);
            Route::post("/",[AdminUserController::class,"store"]);
        });
    });


    Route::fallback(function() {
        return redirect("admin/redirect");
    });    
});

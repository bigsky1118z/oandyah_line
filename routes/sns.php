<?php

use App\Http\Controllers\GlutenFree\GlutenFreeController;
use App\Http\Controllers\GlutenFree\Shop\GlutenFreeShopController;
use App\Http\Controllers\Sns\SnsController;
use App\Http\Controllers\Sns\SnsLinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix("sns")->group(function(){
    Route::get("/", [SnsController::class, "index"]);
    Route::post("/", [SnsController::class, "store"]);
    Route::get("create", [SnsController::class, "create"]);
    Route::post("login", [SnsController::class, "login"]);
    Route::post("logout", [SnsController::class, "logout"]);
    Route::get("regist", [SnsController::class, "user_create"]);
    Route::post("regist", [SnsController::class, "user_store"]);
    
    Route::prefix("{name}")->group(function(){
        Route::get("/", [SnsController::class, "show"]);
        Route::post("/", [SnsController::class, "store"]);
        Route::get("edit", [SnsController::class, "create"]);
        Route::get("delete", [SnsController::class, "delete"]);
        
        Route::get("link", [SnsLinkController::class, "create"]);
        Route::post("link", [SnsLinkController::class, "store"]);
    });
});


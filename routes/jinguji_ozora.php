<?php

use App\Http\Controllers\JingujiOzora\JingujiOzoraController;
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

Route::prefix("jinguji_ozora")->group(function(){
    Route::get("/", [JingujiOzoraController::class, "index"]);
    Route::get("numerology", [JingujiOzoraController::class, "numerology"]);
    Route::prefix("tarot")->group(function(){
        Route::get("/", [JingujiOzoraController::class, "tarot"]);
        Route::get("{name}", [JingujiOzoraController::class, "tarot"]);
        
        Route::post("get_tarot_card", [JingujiOzoraController::class, "get_tarot_card"]);
    });
    Route::prefix("astrology")->group(function(){
        Route::get("/", [JingujiOzoraController::class, "astrology"]);
        Route::post("/", [JingujiOzoraController::class, "astrology"]);
    });

});


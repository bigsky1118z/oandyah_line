<?php

use App\Http\Controllers\GlutenFree\GlutenFreeController;
use App\Http\Controllers\GlutenFree\Shop\GlutenFreeShopController;
use App\Http\Controllers\Line\LineController;
use App\Http\Controllers\Line\LineFriendController;
use App\Http\Controllers\Line\LineGroupController;
use App\Http\Controllers\Line\LineMessageController;
use App\Http\Controllers\Line\LineWebhookController;
use App\Http\Controllers\LineWebhookMessageController;
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

Route::get("/", [LineController::class, "index"]);


Route::prefix("line")->group(function(){
    Route::get("/", [LineController::class, "index"]);
    Route::post("/", [LineController::class, "store"]);
    Route::get("create", [LineController::class, "create"]);
    Route::post("login", [LineController::class, "login"]);
    Route::post("logout", [LineController::class, "logout"]);
    Route::get("regist", [LineController::class, "user_create"]);
    Route::post("regist", [LineController::class, "user_store"]);
    
    Route::prefix("{line_name}")->group(function(){
        Route::get("/", [LineController::class, "show"]);

        Route::prefix("webhook")->group(function(){
            Route::get("/", [LineWebhookController::class, "index"]);
            Route::post("/", [LineWebhookController::class, "webhook"]);
            Route::get("{type}", [LineWebhookController::class, "type"]);
        });

        Route::prefix("friend")->group(function(){
            Route::get("/", [LineFriendController::class, "index"]);
            Route::get("update", [LineFriendController::class, "update"]);
        });
        Route::prefix("group")->group(function(){
            Route::get("/", [LineGroupController::class, "index"]);
            Route::get("{group_name}", [LineGroupController::class, "show"]);
        });
        Route::prefix("message")->group(function(){
            Route::get("/", [LineMessageController::class, "index"]);
            Route::post("/", [LineMessageController::class, "store"]);
            Route::get("create", [LineMessageController::class, "create"]);            
            Route::prefix("iframe")->group(function(){
                Route::get("{iframe}", [LineMessageController::class, "iframe"]);
                Route::post("{iframe}", [LineMessageController::class, "store_message_object"]);
                Route::post("message/object", [LineMessageController::class, "get_message_objects"]);
                Route::get("{iframe}/{message_id}", [LineMessageController::class, "iframe"]);
            });
            // Route::get("sending", [LineMessageController::class, "sending"]);
            Route::prefix("{message_id}")->group(function(){
                Route::get("/", [LineMessageController::class, "show"]);
                Route::post("/", [LineMessageController::class, "store"]);
                Route::get("edit", [LineMessageController::class, "create"]);
                Route::get("delete", [LineMessageController::class, "delete"]);
                Route::get("sending", [LineMessageController::class, "sending"]);
            });
            
        });
    });
});


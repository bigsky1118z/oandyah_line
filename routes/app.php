<?php

use App\Http\Controllers\App\AppAutoController;
use App\Http\Controllers\App\AppController;
use App\Http\Controllers\App\AppFriendController;
use App\Http\Controllers\App\AppImageController;
use App\Http\Controllers\App\AppMessageController;
use App\Http\Controllers\App\AppReplyController;
use App\Http\Controllers\App\AppReplyMessageController;
use App\Http\Controllers\App\AppRichmenuController;
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


Route::prefix("app")->middleware("check_user_name")->group(function(){
    Route::get("/",[AppController::class,"index"]);
    Route::get("create",[AppController::class,"create"]);
    Route::post("/",[AppController::class,"store"]);
    Route::prefix("{client_id}")->group(function(){
        Route::get("/",[AppController::class,"show"]);
        Route::prefix("webhook")->group(function(){
            Route::get("/",[AppWebhookController::class,"index"]);
            Route::get("{id}",[AppWebhookController::class,"show"]);
        });

        Route::prefix("friend")->group(function(){
            Route::get("/",[AppFriendController::class,"index"]);
            Route::get("{friend_id}",[AppFriendController::class,"show"]);
        });
        Route::prefix("reply")->group(function(){
            Route::get("/",[AppReplyController::class,"index"]);
            Route::get("create",[AppReplyController::class,"create"]);
            Route::get("{reply_id}",[AppReplyController::class,"create"]);
            Route::post("{reply_id?}",[AppReplyController::class,"store"]);
            Route::prefix("{reply_id}/message")->group(function(){
                Route::get("{message_id?}",[AppReplyMessageController::class,"create"]);
                Route::post("{message_id?}",[AppReplyMessageController::class,"store"]);
            });
        });
        Route::prefix("message")->group(function(){
            Route::get("/",[AppMessageController::class,"index"]);
            Route::get("create",[AppMessageController::class,"create"]);
            Route::get("{message_id}",[AppMessageController::class,"create"]);
            Route::post("{message_id?}",[AppMessageController::class,"store"]);
            Route::post("{message_id}/send",[AppMessageController::class,"send"]);
        });
        Route::prefix("richmenu")->group(function(){
            Route::get("/",[AppRichmenuController::class,"index"]);
            Route::get("create",[AppRichmenuController::class,"create"]);
            Route::get("{app_richmenu_id}",[AppRichmenuController::class,"create"]);
            Route::post("update",[AppRichmenuController::class,"update"]);
            Route::post("{app_richmenu_id?}",[AppRichmenuController::class,"store"]);
            Route::post("{app_richmenu_id}/upload",[AppRichmenuController::class,"upload"]);
            Route::post("{app_richmenu_id}/default",[AppRichmenuController::class,"post_default"]);
            Route::delete("default",[AppRichmenuController::class,"delete_default"]);
            Route::delete("{app_richmenu_id}",[AppRichmenuController::class,"destroy"]);
        });
        Route::prefix("image")->group(function(){
            Route::get("{name1?}/{name2?}/{name3?}/{name4?}/{name5?}",[AppImageController::class,"index"]);
            Route::post("{name1?}/{name2?}/{name3?}/{name4?}/{name5?}",[AppImageController::class,"store"]);
            Route::delete("{name1?}/{name2?}/{name3?}/{name4?}/{name5?}",[AppImageController::class,"destroy"]);
        });
    });
});
Route::get("news",[AppController::class,"index"]);
Route::get("message",[AppController::class,"index"]);


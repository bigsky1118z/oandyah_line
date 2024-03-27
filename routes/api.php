<?php

use App\Http\Controllers\Admin\Api\LineApiChannelController;
use App\Http\Controllers\Admin\Api\LineApiController;
use App\Http\Controllers\Admin\Api\LineApiEventController;
use App\Http\Controllers\Admin\Api\LineApiImageController;
use App\Http\Controllers\Admin\Api\LineApiMessageController;
use App\Http\Controllers\Admin\Api\LineApiOrderController;
use App\Http\Controllers\Admin\Api\LineApiOrderItemController;
use App\Http\Controllers\Admin\Api\LineApiOrderMenuController;
use App\Http\Controllers\Admin\Api\LineApiReceiveController;
use App\Http\Controllers\Admin\Api\LineApiReplyController;
use App\Http\Controllers\Admin\Api\LineApiRichmenuController;
use App\Http\Controllers\Admin\Api\LineApiSendController;
use App\Http\Controllers\Admin\Api\LineApiUserController;
use App\Http\Controllers\Admin\Api\LineApiUserGroupController;
use App\Http\Controllers\Api\JwebController;
use App\Http\Controllers\Api\Twitter\TwitterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('jweb')->group(function(){
    Route::get('/',[JwebController::class,"index"]);
    Route::get('archive',[JwebController::class,"archive"]);
    Route::get('artist',[JwebController::class,"artist"]);
    Route::get('diary',[JwebController::class,"diary"]);
});

Route::prefix('twitter')->group(function(){
    Route::get('auth/redirect',[TwitterController::class,"redirect"]);
    Route::get('auth/callback',[TwitterController::class,"callback"]);
});

Route::prefix('line')->group(function(){
    Route::get('/',[LineApiController::class,"index"]);
    Route::get('create',[LineApiChannelController::class,"create"]);
    Route::post('create',[LineApiChannelController::class,"store"]);


    Route::prefix('{channel_name}')->group(function () {
        Route::get('/',[LineApiChannelController::class,"index"]);
        Route::post('upload/image',[LineApiController::class, 'upload_image']);

        Route::get('info',[LineApiChannelController::class, 'info']);

        Route::get('statistic',[LineApiController::class, 'statistic']);
        
        Route::prefix('image')->group(function () {
            Route::get('/',[LineApiImageController::class, 'index']);
            Route::post('/',[LineApiImageController::class, 'store']);
            Route::post('rename',[LineApiImageController::class, 'rename']);
            Route::post('delete',[LineApiImageController::class, 'delete']);
        });

        Route::prefix('user')->group(function () {
            Route::get('/',[LineApiUserController::class, 'index']);

            Route::prefix('group')->group(function () {
                Route::get('/',[LineApiUserGroupController::class, 'index']);
                Route::get('{id}',[LineApiUserGroupController::class, 'show']);
                Route::get('{id}/edit',[LineApiUserGroupController::class, 'edit']);
                Route::get('{id}/update',[LineApiUserGroupController::class, 'update']);
                Route::get('{id}/delete',[LineApiUserGroupController::class, 'delete']);
            });

            Route::get('create',[LineApiUserController::class, 'create']);
            Route::get('info',[LineApiUserController::class, 'info']);
            Route::post('/',[LineApiUserController::class, 'store']);
            Route::post('csv/import',[LineApiUserController::class, 'import']);
            Route::get('csv/export',[LineApiUserController::class, 'export']);
            Route::get('{id}',[LineApiUserController::class, 'show']);
            Route::get('{id}/edit',[LineApiUserController::class, 'edit']);
            Route::get('{id}/info',[LineApiUserController::class, 'info']);
            Route::post('{id}',[LineApiUserController::class, 'update']);
        });

        Route::prefix('message')->group(function () {

            Route::get('/',[LineApiMessageController::class, 'index']);
            Route::get('create/{type}',[LineApiMessageController::class, 'create']);
            Route::post('/',[LineApiMessageController::class, 'store']);
            Route::get('{id}/delete',[LineApiMessageController::class, 'delete']);

            Route::get('async/create/{type}',[LineApiMessageController::class, 'async_create']);
            Route::post('async/list',[LineApiMessageController::class, 'async_list']);

            // Route::post('{id}',[LineApiMessageController::class, 'message_json']);
            // Route::post('get/form/{type}',[LineApiMessageController::class, 'form']);
        });
        Route::prefix('receive')->group(function () {
            Route::get('/',[LineApiReceiveController::class, 'index']);
            Route::get('event',[LineApiReceiveController::class, 'event']);
            Route::get('message',[LineApiReceiveController::class, 'message']);
            Route::get('postback',[LineApiReceiveController::class, 'postback']);
            Route::get('postback/order/',[LineApiReceiveController::class, 'postback_order']);
            // Route::get('postback/order/{name}',[LineApiReceiveController::class, 'postback_order']);
            Route::get('postback/{action}',[LineApiReceiveController::class, 'postback_action']);
            Route::get('postback/{action}/{name}',[LineApiReceiveController::class, 'postback_action_name']);
            Route::post('postback/{action}/{name}',[LineApiReceiveController::class, 'postback_action_name_reaction']);
            
            Route::get('postback/order/{name}/{line_user_id}',[LineApiReceiveController::class, 'postback_order_user']);
        });
        Route::prefix('order')->group(function () {
            Route::get('/',[LineApiOrderController::class, 'index']);
            Route::prefix('item')->group(function () {
                Route::get('/',[LineApiOrderItemController::class, 'index']);
                Route::get('create',[LineApiOrderItemController::class, 'create']);
                Route::post('/',[LineApiOrderItemController::class, 'store']);
                
                Route::get('async/create',[LineApiOrderItemController::class, 'async_create']);
                Route::get('async/list',[LineApiOrderItemController::class, 'async_list']);
                Route::get('async/{id}',[LineApiOrderItemController::class, 'async_detail']);

                Route::get('{id}',[LineApiOrderItemController::class, 'show']);
                Route::get('{id}/edit',[LineApiOrderItemController::class, 'edit']);
                Route::post('{id}',[LineApiOrderItemController::class, 'update']);
                Route::get('{id}/delete',[LineApiOrderItemController::class, 'delete']);
            });

            Route::prefix('menu')->group(function () {
                Route::get('/',[LineApiOrderMenuController::class, 'index']);
                Route::get('create',[LineApiOrderMenuController::class, 'create']);
                Route::post('/',[LineApiOrderMenuController::class, 'store']);
                Route::get('{group}/edit',[LineApiOrderMenuController::class, 'edit']);
                Route::post('{group}',[LineApiOrderMenuController::class, 'update']);
                Route::get('{group}/delete',[LineApiOrderMenuController::class, 'delete']);

                Route::get('{group}/item',[LineApiOrderMenuController::class, 'item']);
                Route::get('{group}/item/create',[LineApiOrderMenuController::class, 'item_create']);
                Route::post('{group}/item',[LineApiOrderMenuController::class, 'item_store']);
                Route::get('{group}/item/{id}',[LineApiOrderMenuController::class, 'item_show']);
                Route::get('{group}/item/{id}/edit',[LineApiOrderMenuController::class, 'item_edit']);
                Route::post('{group}/item/{id}',[LineApiOrderMenuController::class, 'item_update']);
                Route::get('{group}/item/{id}/delete',[LineApiOrderMenuController::class, 'item_delete']);
            });
                    
            Route::get('{name}',[LineApiOrderController::class, 'name']);
            Route::get('{name}/paid',[LineApiOrderController::class, 'paid']);
            Route::get('{name}/all',[LineApiOrderController::class, 'all']);
            Route::post('{name}/all',[LineApiOrderController::class, 'all']);
            Route::get('{name}/user',[LineApiOrderController::class, 'users']);
            Route::get('{name}/user/{id}',[LineApiOrderController::class, 'user']);
            Route::get('{name}/status/{id}/{status}',[LineApiOrderController::class, 'update_status']);
        });

        Route::prefix('event')->group(function () {
            Route::get('/',[LineApiEventController::class, 'index']);
            Route::get('create',[LineApiEventController::class, 'create']);
            Route::post('/',[LineApiEventController::class, 'store']);
            Route::get('{event_name}',[LineApiEventController::class, 'event']);
            Route::get('{event_name}/create',[LineApiEventController::class, 'create']);
            Route::post('{event_name}',[LineApiEventController::class, 'store']);
            Route::get('{event_name}/{id}',[LineApiEventController::class, 'show']);
            Route::get('{event_name}/{id}/edit',[LineApiEventController::class, 'edit']);
            Route::get('{event_name}/{id}/delete',[LineApiEventController::class, 'delete']);
        });


        Route::prefix('send')->group(function () {
            Route::get('/',[LineApiSendController::class, 'index']);
            Route::get('create',[LineApiSendController::class, 'create']);
            Route::get('create2',[LineApiSendController::class, 'create2']);
            Route::post('create',[LineApiSendController::class, 'store']);
            Route::get('{id}/delete',[LineApiSendController::class, 'delete']);
        });
        Route::get('send2',[LineApiSendController::class, 'index2']);

        Route::prefix('reply')->group(function () {
            Route::get('/',[LineApiReplyController::class, 'index']);
            Route::post('{type}',[LineApiReplyController::class, 'store']);
            Route::post('{type}/{id}',[LineApiReplyController::class, 'update']);
            Route::post('{type}/{id}/active',[LineApiReplyController::class, 'active']);
            Route::post('{type}/{id}/inactive',[LineApiReplyController::class, 'inactive']);
            
            Route::prefix('follow')->group(function () {
                Route::get('/',[LineApiReplyController::class, 'follow']);
                Route::get('create',[LineApiReplyController::class, 'follow_create']);
                Route::get('test',[LineApiReplyController::class, 'follow_test']);
                Route::get('{id}',[LineApiReplyController::class, 'follow_show']);
                Route::get('{id}/edit',[LineApiReplyController::class, 'follow_edit']);
                Route::get('{id}/delete',[LineApiReplyController::class, 'follow_delete']);
            });
            Route::prefix('postback')->group(function () {
                Route::get('/',[LineApiReplyController::class, 'postback']);
                Route::get('event',[LineApiEventController::class, 'reply_index']);
                Route::get('order',[LineApiOrderController::class, 'reply_index']);
                
                // Route::get('{action}',[LineApiReplyController::class, 'postback_action']);
                // Route::post('{action}',[LineApiReplyController::class, 'postback_store']);
                // Route::get('{action}/create',[LineApiReplyController::class, 'postback_action_create']);
                // Route::get('{action}/{id}/edit',[LineApiReplyController::class, 'postback_action_edit']);
            });
            
            // Route::get('{type}/{action}/{id}/delete',[LineApiReplyController::class, 'type_action_delete']);
            // Route::post('{type}/default/active',[LineApiReplyController::class, 'type_default_active']);
        });

        /** LineApiReply */

        /** LineApiRichmenu */
        Route::get('richmenu',[LineApiRichmenuController::class, 'index']);
        Route::get('richmenu/create',[LineApiRichmenuController::class, 'create']);
        Route::post('richmenu',[LineApiRichmenuController::class, 'store']);
        Route::get('richmenu/{richmenu_id}',[LineApiRichmenuController::class, 'show']);
        Route::get('richmenu/{richmenu_id}/default',[LineApiRichmenuController::class, 'default']);
        Route::get('richmenu/{richmenu_id}/delete',[LineApiRichmenuController::class, 'delete']);
    });
});

Route::post('line/{channel_name}',[LineApiController::class,"receive_webhook"]);
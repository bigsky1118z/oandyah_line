<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Website\Page\WebsitePageContactController;
use App\Http\Controllers\Website\Page\WebsitePageContactFormController;
use App\Http\Controllers\Website\Page\WebsitePageContactPostController;
use App\Http\Controllers\Website\Page\WebsitePageMenuController;
use App\Http\Controllers\Website\Page\WebsitePageMenuLinkController;
use App\Http\Controllers\Website\Page\WebsitePageMultipleArticleController;
use App\Http\Controllers\Website\Page\WebsitePageMultipleController;
use App\Http\Controllers\Website\Page\WebsitePageSingleController;
use App\Http\Controllers\Website\WebsiteConfigController;
use App\Http\Controllers\Website\WebsiteLayoutController;
use App\Http\Controllers\Website\WebsitePageController;
use App\Http\Controllers\Website\WebsiteStyleController;
use App\Http\Controllers\Website\WebsiteMembershipController;
use App\Http\Controllers\WebsiteController;
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

Route::prefix('edit')->middleware('auth')->middleware('can:is_admin')->group(function() {
    Route::get('/',[WebsiteController::class, 'edit']);

    Route::prefix('user')->group(function() {
        Route::get('/',[UserController::class, 'index']);
        Route::post('/',[UserController::class, 'store']);
        Route::get('create',[UserController::class, 'create']);
        Route::prefix('{user_id}')->group(function() {
            Route::get('/',[UserController::class, 'show']);
            Route::post('/',[UserController::class, 'store']);
            Route::get('edit',[UserController::class, 'create']);
            Route::get('delete',[UserController::class, 'delete']);
        });
    });

    Route::prefix('config')->group(function() {
        Route::get('/',[WebsiteConfigController::class, 'index']);
        Route::get('{config_name}',[WebsiteConfigController::class, 'create']);
        Route::post('{config_name}',[WebsiteConfigController::class, 'store']);
    });


    Route::prefix('page')->group(function() {
        Route::get('/',[WebsitePageController::class, 'index']);
        Route::prefix('single')->group(function() {
            Route::get('/',[WebsitePageSingleController::class, 'index']);
            Route::post('/',[WebsitePageSingleController::class, 'store']);
            Route::get('create',[WebsitePageSingleController::class, 'create']);
            Route::prefix('{page_id}')->group(function() {
                Route::get('/',[WebsitePageSingleController::class, 'show']);
                Route::post('/',[WebsitePageSingleController::class, 'store']);
                Route::get('edit',[WebsitePageSingleController::class, 'create']);
                Route::get('delete',[WebsitePageController::class, 'delete']);
            });
        });
        Route::prefix('multiple')->group(function() {
            Route::get('/',[WebsitePageMultipleController::class, 'index']);
            Route::post('/',[WebsitePageMultipleController::class, 'store']);
            Route::get('create',[WebsitePageMultipleController::class, 'create']);
            Route::prefix('{page_id}')->group(function() {
                Route::get('/',[WebsitePageMultipleController::class, 'show']);
                Route::post('/',[WebsitePageMultipleController::class, 'store']);
                Route::get('edit',[WebsitePageMultipleController::class, 'create']);
                Route::get('delete',[WebsitePageController::class, 'delete']);

                Route::get('create',[WebsitePageMultipleArticleController::class, 'create']);
                Route::post('new_article',[WebsitePageMultipleArticleController::class, 'store']);
                Route::prefix('{article_id}')->group(function() {
                    Route::get('/',[WebsitePageMultipleArticleController::class, 'show']);
                    Route::post('/',[WebsitePageMultipleArticleController::class, 'store']);
                    Route::get('edit',[WebsitePageMultipleArticleController::class, 'create']);
                    Route::get('delete',[WebsitePageMultipleArticleController::class, 'delete']);
                });
            });
        });
        Route::prefix('menu')->group(function() {
            Route::get('/',[WebsitePageMenuController::class, 'index']);
            Route::post('/',[WebsitePageMenuController::class, 'store']);
            Route::get('create',[WebsitePageMenuController::class, 'create']);
            Route::prefix('{page_id}')->group(function() {
                Route::get('/',[WebsitePageMenuController::class, 'show']);
                Route::post('/',[WebsitePageMenuController::class, 'store']);
                Route::get('edit',[WebsitePageMenuController::class, 'create']);
                Route::get('delete',[WebsitePageController::class, 'delete']);

                Route::get('link',[WebsitePageMenuLinkController::class, 'create']);
                Route::post('link',[WebsitePageMenuLinkController::class, 'store']);
            });
        });
        Route::prefix('contact')->group(function() {
            Route::get('/',[WebsitePageContactController::class, 'index']);
            Route::post('/',[WebsitePageContactController::class, 'store']);
            Route::get('create',[WebsitePageContactController::class, 'create']);
            Route::prefix('{page_id}')->group(function() {
                Route::get('/',[WebsitePageContactController::class, 'show']);
                Route::post('/',[WebsitePageContactController::class, 'store']);
                Route::get('edit',[WebsitePageContactController::class, 'create']);
                Route::get('delete',[WebsitePageController::class, 'delete']);

                Route::get('form',[WebsitePageContactFormController::class, 'create']);
                Route::post('form',[WebsitePageContactFormController::class, 'store']);

                Route::get('post',[WebsitePageContactPostController::class, 'index']);
                Route::post('post',[WebsitePageContactPostController::class, 'store']);
            });
        });


        Route::get('subdirectory',[WebsitePageController::class, 'subdirectory']);

    });


    Route::prefix('layout')->group(function() {
        Route::get('/',[WebsiteLayoutController::class, 'index']);
        Route::get('{type}',[WebsiteLayoutController::class, 'create']);
        Route::post('{type}',[WebsiteLayoutController::class, 'store']);
    });

    
    Route::prefix('image')->group(function() {
        Route::get('/',[ImageController::class, 'directory_index']);
        Route::post('/',[ImageController::class, 'directory_store']);
        Route::get('{directory}/delete',[ImageController::class, 'directory_delete']);
        Route::prefix('{directory}')->group(function() {
            Route::get('/',[ImageController::class, 'file_index']);
            Route::post('/',[ImageController::class, 'file_store']);
            Route::post('rename',[ImageController::class, 'file_rename']);
            Route::get('{flie_name}/delete',[ImageController::class, 'file_delete']);
            // Route::delete('/',[ImageController::class, 'file_delete2']);
        });
    });
    

    Route::prefix('style')->group(function() {
        Route::get('/',[WebsiteStyleController::class, 'index']);
        Route::get('default',[WebsiteStyleController::class, 'default']);
        Route::get('customize',[WebsiteStyleController::class, 'customize']);
        Route::get('create',[WebsiteStyleController::class, 'create']);
        Route::post('/',[WebsiteStyleController::class, 'store']);
        Route::post('update',[WebsiteStyleController::class, 'update']);
        Route::get('{id}/delete',[WebsiteStyleController::class, 'delete']);
    });
    Route::prefix('layout')->group(function() {
        Route::get('/',[WebsiteLayoutController::class, 'index']);
        Route::get('top',[WebsiteLayoutController::class, 'top']);
        Route::get('{category}/create',[WebsiteLayoutController::class, 'create']);
        Route::post('{category}',[WebsiteLayoutController::class, 'store']);
        Route::post('{category}/order',[WebsiteLayoutController::class, 'order']);
        Route::get('{category}/{id}/delete',[WebsiteLayoutController::class, 'delete']);
    });

    Route::prefix('membership')->group(function() {
        Route::get('/',[WebsiteMembershipController::class, 'index']);
        Route::get('create',[WebsiteMembershipController::class, 'create']);
        Route::post('/',[WebsiteMembershipController::class, 'store']);
        Route::get('{membership_id}',[WebsiteMembershipController::class, 'create']);
        Route::post('{membership_id}',[WebsiteMembershipController::class, 'store']);
        Route::get('{membership_id}/delete',[WebsiteMembershipController::class, 'delete']);
    });

});
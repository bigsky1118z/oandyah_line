<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Website\ArticleController;
use App\Http\Controllers\Admin\Website\ContentController;
use App\Http\Controllers\Admin\Website\MenuController;
use App\Http\Controllers\Admin\Website\ExtensionController;
use App\Http\Controllers\Admin\Website\HeadController;
use App\Http\Controllers\Admin\Website\HeaderController;
use App\Http\Controllers\Admin\Website\ImageController;
use App\Http\Controllers\Admin\Website\LayoutController;
use App\Http\Controllers\Admin\Website\PageController;
use App\Http\Controllers\Admin\Website\StyleController;
use App\Http\Controllers\Admin\Website\TopController;
use App\Http\Controllers\Admin\Webapp\CompanyController;
use App\Http\Controllers\Admin\Webapp\CsvController;
use App\Http\Controllers\Admin\Webapp\ProductController;
use App\Http\Controllers\Admin\Api\LineApiForClientController;
use App\Http\Controllers\Admin\Webapp\CompanyProvideProductController;
use App\Http\Controllers\Admin\Webapp\SemiProductController;
use Illuminate\Support\Facades\Route;
use Whoops\RunInterface;

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

Route::prefix('admin')->middleware('can:isAdmin')->group(function () {
    Route::get('/',[AdminController::class, 'index']);
    
    Route::resource('user',UserController::class);

    Route::get('webapp',[AdminController::class,'webapp']);
    Route::prefix('webapp')->group(function(){
        Route::resource('company',CompanyController::class);
        Route::resource('product',ProductController::class);
        Route::resource('semi_product',SemiProductController::class);
        Route::resource('provide',CompanyProvideProductController::class);
    });

    Route::get('website',[AdminController::class,'website']);
    Route::prefix('website')->group(function(){
        Route::get('head',[HeadController::class,'edit']);
        Route::post('head',[HeadController::class,'update']);
        Route::get('header',[HeaderController::class,'edit']);
        Route::post('header',[HeaderController::class,'update']);
        Route::get('layout',[LayoutController::class,'edit']);
        Route::post('layout',[LayoutController::class,'update']);
        Route::get('style', [StyleController::class,'edit']);
        Route::post('style', [StyleController::class,'update']);
        Route::get('top',[TopController::class,'edit']);
        Route::post('top',[TopController::class,'update']);
        Route::get('extension',[ExtensionController::class,'edit']);
        Route::post('extension',[ExtensionController::class,'update']);
        
        Route::prefix("article")->group(function(){
            Route::get("/", [ArticleController::class,'index']);
            Route::get("/{page_name}", [ArticleController::class,'page']);
            Route::get("/{page_name}/create", [ArticleController::class,'create']);
            Route::post("/{page_name}", [ArticleController::class,'store']);
            Route::get("/{page_name}/{path}", [ArticleController::class,'show']);
            Route::get("/{page_name}/{path}/edit", [ArticleController::class,'edit']);
            Route::post("/{page_name}/{path}", [ArticleController::class,'update']);
            Route::delete("/{page_name}/{path}", [ArticleController::class,'destroy']);
        });

        Route::resource('page',PageController::class);
        Route::resource('menu',MenuController::class);
        Route::resource('image',ImageController::class,);
        Route::resource('content',ContentController::class);
    });
    
    Route::prefix('api')->group(function(){
        Route::get('companiesExport',[CsvController::class, 'CompaniesExport']);
        Route::get('client',[LineApiForClientController::class,"get"]);
    });
});


require __DIR__.'/auth.php';

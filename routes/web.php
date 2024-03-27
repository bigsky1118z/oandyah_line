<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Website\Page\WebsitePageMultipleController;
use App\Http\Controllers\Website\Page\WebsitePageSingleController;
use App\Http\Controllers\Website\WebsiteConfigController;
use App\Http\Controllers\Website\WebsitePageController;
use App\Http\Controllers\Website\WebsiteStyleController;
use App\Http\Controllers\Website\WebsiteLayoutController;
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

/**
 * sub domain rooting
 */

Route::domain("line.oandyah.com")->group(function(){
    require __DIR__.'/line.php';
});



Route::get('/', [WebsiteController::class,'index']);
// Route::get('test', [WebsiteController::class,'index1']);
Route::get('style.css', [WebsiteController::class,'style']);
Route::get('redirect',[WebsiteController::class, 'redirect']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
require __DIR__.'/edit.php';


require __DIR__.'/pokemon.php';
require __DIR__.'/jinguji_ozora.php';
require __DIR__.'/kbox.php';
require __DIR__.'/gluten_free.php';
require __DIR__.'/sns.php';
require __DIR__.'/line.php';

// Route::prefix('edit')->middleware('auth')->middleware('can:is_admin')->group(function() {
//     Route::get('/',[WebsiteController::class, 'edit']);
//     Route::prefix('user')->middleware('auth')->group(function() {
//         Route::get('/',[UserController::class, 'index']);
//         Route::post('/',[UserController::class, 'store']);
//         Route::get('create',[UserController::class, 'create']);
//         Route::prefix('{user_id}')->group(function() {
//             Route::get('/',[UserController::class, 'show']);
//             Route::post('/',[UserController::class, 'store']);
//             Route::get('edit',[UserController::class, 'create']);
//             Route::get('delete',[UserController::class, 'delete']);
//         });
//     });
    
//     Route::prefix('image')->group(function() {
//         Route::get('/',[ImageController::class, 'directory_index']);
//         Route::post('/',[ImageController::class, 'directory_store']);
//         Route::get('{directory}',[ImageController::class, 'file_index']);
//         Route::get('{directory}/delete',[ImageController::class, 'directory_delete']);
//         Route::post('{directory}',[ImageController::class, 'file_store']);
//         Route::post('{directory}/rename',[ImageController::class, 'file_rename']);
//         Route::delete('{directory}',[ImageController::class, 'file_delete']);
//     });
    
//     Route::prefix('config')->group(function() {
//         Route::get('/',[WebsiteConfigController::class, 'edit']);
//         Route::post('/',[WebsiteConfigController::class, 'update']);
//         Route::post('delete',[WebsiteConfigController::class, 'delete']);
//     });

//     Route::prefix('page')->group(function() {
//         Route::get('/',[WebsitePageController::class, 'index']);
//         Route::get('{category}/create',[WebsitePageController::class, 'create']);
//         Route::post('{category}',[WebsitePageController::class, 'store']);
//         Route::get('{category}/{id}',[WebsitePageController::class, 'create']);
//         Route::post('{category}/{id}',[WebsitePageController::class, 'store']);
//         Route::get('{category}/{id}/delete',[WebsitePageController::class, 'delete']);
//     });

//     Route::prefix('single')->group(function() {
//         Route::get('/',[WebsitePageSingleController::class, 'index']);
//         Route::get('{id}',[WebsitePageSingleController::class, 'create']);
//         Route::post('{id}',[WebsitePageSingleController::class, 'store']);
//     });

//     Route::prefix('multiple')->group(function() {
//         // Route::get('/',[WebsitePageMultipleController::class, 'list']);
//         Route::get('{page_id}',[WebsitePageMultipleController::class, 'index']);
//         Route::get('{page_id}/create',[WebsitePageMultipleController::class, 'create']);
//         Route::post('{page_id}',[WebsitePageMultipleController::class, 'store']);
//         Route::get('{page_id}/{multple_id}',[WebsitePageMultipleController::class, 'create']);
//         Route::post('{page_id}/{multple_id}',[WebsitePageMultipleController::class, 'store']);
//         Route::get('{page_id}/{multple_id}/delete',[WebsitePageMultipleController::class, 'delete']);
//     });


//     Route::prefix('style')->group(function() {
//         Route::get('/',[WebsiteStyleController::class, 'index']);
//         Route::get('default',[WebsiteStyleController::class, 'default']);
//         Route::get('customize',[WebsiteStyleController::class, 'customize']);
//         Route::get('create',[WebsiteStyleController::class, 'create']);
//         Route::post('/',[WebsiteStyleController::class, 'store']);
//         Route::post('update',[WebsiteStyleController::class, 'update']);
//         Route::get('{id}/delete',[WebsiteStyleController::class, 'delete']);
//     });
//     Route::prefix('layout')->group(function() {
//         Route::get('/',[WebsiteLayoutController::class, 'index']);
//         Route::get('top',[WebsiteLayoutController::class, 'top']);
//         Route::get('{category}/create',[WebsiteLayoutController::class, 'create']);
//         Route::post('{category}',[WebsiteLayoutController::class, 'store']);
//         Route::post('{category}/order',[WebsiteLayoutController::class, 'order']);
//         Route::get('{category}/{id}/delete',[WebsiteLayoutController::class, 'delete']);
//     });

//     Route::prefix('membership')->group(function() {
//         Route::get('/',[WebsiteMembershipController::class, 'index']);
//         Route::get('create',[WebsiteMembershipController::class, 'create']);
//         Route::post('/',[WebsiteMembershipController::class, 'store']);
//         Route::get('{membership_id}',[WebsiteMembershipController::class, 'create']);
//         Route::post('{membership_id}',[WebsiteMembershipController::class, 'store']);
//         Route::get('{membership_id}/delete',[WebsiteMembershipController::class, 'delete']);
//     });

// });

Route::prefix('{page_name}')->group(function() {
    Route::get('/',[WebsiteController::class, 'get']);
    Route::post('/',[WebsiteController::class, 'post']);
    Route::get('{path1}',[WebsiteController::class, 'get']);
    Route::post('{path1}',[WebsiteController::class, 'post']);
    Route::get('{path1}/{path2}',[WebsiteController::class, 'get']);
    Route::post('{path1}/{path2}',[WebsiteController::class, 'post']);
    Route::get('{path1}/{path2}/{path3}',[WebsiteController::class, 'get']);
    Route::post('{path1}/{path2}/{path3}',[WebsiteController::class, 'post']);
});


Route::fallback(function() {
    return redirect("redirect");
});
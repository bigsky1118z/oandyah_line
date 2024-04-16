<?php

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
| be assigned to the "web" middleware group. Make something great!
|
*/


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

Route::get("/",[WebController::class,"index"]);
Route::get("create",[WebController::class,"create"]);
Route::post("/",[WebController::class,"store"]);
Route::get("app",[WebController::class,"app"]);

Route::get("app/{app_name}",[AppWebhookController::class,"get"]);
Route::post("app/{app_name}",[AppWebhookController::class,"post"]);

Route::get("redirect",[WebController::class,"redirect"]);

Route::prefix("{user_name}")->group(function(){
    Route::middleware("check_user_name")->get("/",[WebController::class, "show"]);
    require __DIR__.'/app.php';
});




// Route::prefix("dashboard")->group(function(){
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// Route::middleware('auth')->prefix("profile")->group(function(){
//     Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// Route::middleware('auth')->prefix("{user_name}")->group(function(){
//     return "login";
//     // Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
//     // Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
//     // Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



Route::fallback(function() {
    return redirect("redirect");
});

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

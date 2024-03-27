<?php

use App\Http\Controllers\Kbox\KboxCompanyController;
use App\Http\Controllers\Kbox\KboxController;
use App\Http\Controllers\Kbox\KboxProductController;
use App\Http\Controllers\Kbox\KboxSemiProductController;
use App\Http\Controllers\Kbox\KboxSheetController;
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

// Route::prefix("kbox")->middleware("can:isAdmin")->group(function () {
Route::prefix("kbox")->group(function () {
    Route::get("/",[KboxController::class, "index"]);
    Route::post("/",[KboxController::class, "login"]);
    Route::get("logout",[KboxController::class, "logout"]);
    Route::middleware("auth")->group(function () {
        Route::prefix("user")->group(function () {
            Route::get("/",[KboxController::class, "user_index"]);
            Route::get("{user_id}",[KboxController::class, "user_show"]);
        });
        Route::prefix("sheet")->group(function () {
            Route::get("/",[KboxSheetController::class, "index"]);
            Route::prefix("{sheet_id}")->group(function () {
                Route::get("/",[KboxSheetController::class, "show"]);
            });
        });
        Route::prefix("product")->group(function () {
            Route::get("/",[KboxProductController::class, "index"]);

            Route::get("csv",[KboxProductController::class, "export"]);
            Route::post("csv",[KboxProductController::class, "import"]);

            Route::prefix("semi_product")->group(function () {
                Route::get("/",[KboxSemiProductController::class, "index"]);

                Route::get("csv",[KboxSemiProductController::class, "export"]);
                Route::post("csv",[KboxSemiProductController::class, "import"]);
                Route::prefix("{semi_product_id}")->group(function () {
                    Route::get("/",[KboxSemiProductController::class, "show"]);
                    Route::get("delete",[KboxSemiProductController::class, "delete"]);
                });

            });
            Route::prefix("{product_id}")->group(function () {
                Route::get("/",[KboxProductController::class, "show"]);
                Route::get("delete",[KboxProductController::class, "delete"]);
            });
        });

        Route::prefix("company")->group(function () {
            Route::get("/",[KboxCompanyController::class, "index"]);
            Route::get("schedule_backup_database",[KboxCompanyController::class, "schedule_backup_database"]);
            Route::get("hoge",[KboxCompanyController::class, "hoge"]);
            Route::prefix("csv")->group(function () {
                Route::get("{database}",[KboxCompanyController::class, "export"]);
                Route::post("{database}",[KboxCompanyController::class, "import"]);
            });
            Route::get("delete",[KboxCompanyController::class, "delete"]);
            Route::prefix("{company_id}")->group(function () {
                Route::get("/",[KboxCompanyController::class, "show"]);
                Route::post("address",[KboxCompanyController::class, "address"]);
                Route::get("address/{address_id}/delete",[KboxCompanyController::class, "address_delete"]);
                Route::post("contact",[KboxCompanyController::class, "contact"]);
                Route::get("contact/{contact_id}/delete",[KboxCompanyController::class, "contact_delete"]);
            });
        });
        Route::get("order",[KboxController::class, "index"]);
    });
});

require __DIR__."/auth.php";

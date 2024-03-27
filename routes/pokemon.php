<?php

use App\Http\Controllers\Pokemon\PokemonController;
use App\Http\Controllers\Pokemon\PokemonLeagueController;
use App\Http\Controllers\Pokemon\PokemonPokedexController;
use App\Http\Controllers\Pokemon\PokemonTrainerController;
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

Route::prefix('pokemon')->group(function(){
    Route::get('/', [PokemonController::class, 'index']);
    Route::prefix('trainer')->group(function(){
        Route::get("/",[PokemonTrainerController::class, "index"]);
        Route::post("/",[PokemonTrainerController::class, "store"]);
        Route::post("async",[PokemonTrainerController::class, "store"]);
        Route::prefix('{trainer_id}')->group(function(){
            Route::get("delete",[PokemonTrainerController::class, "delete"]);
        });
    });
    Route::prefix('league')->group(function(){
        Route::get("/",[PokemonLeagueController::class, "index"]);
        Route::get("create",[PokemonLeagueController::class, "create"]);
        Route::post("/",[PokemonLeagueController::class, "store"]);
        Route::prefix("{league_id}")->group(function(){
            Route::get("/",[PokemonLeagueController::class, "show"]);
            Route::get("match",[PokemonLeagueController::class, "match"]);
            Route::post("match",[PokemonLeagueController::class, "match_result"]);
            Route::get("edit",[PokemonLeagueController::class, "create"]);
            Route::post("/",[PokemonLeagueController::class, "store"]);
            Route::get("delete",[PokemonLeagueController::class, "delete"]);
            Route::prefix("trainer")->group(function(){
                Route::post("/",[PokemonLeagueController::class, "trainer_store"]);
                Route::get("{trainer_id}/delete",[PokemonLeagueController::class, "trainer_delete"]);
            });
        });
        
    });
    Route::get('pokedex', [PokemonPokedexController::class, 'index']);
});


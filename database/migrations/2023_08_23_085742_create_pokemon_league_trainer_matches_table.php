<?php

use App\Models\Pokemon\PokemonLeague;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pokemon_league_trainer_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PokemonLeague::class)->constrained()->cascadeOnDelete();
            $table->string("name")->nullable();
            $table->string("round")->nullable();
            $table->string("group")->nullable();
            $table->string("code")->nullable();
            $table->unsignedBigInteger('player1_id')->nullable();
            $table->foreign('player1_id')->references('id')->on('pokemon_league_trainers')->cascadeOnDelete();
            $table->unsignedBigInteger('player2_id')->nullable();
            $table->foreign('player2_id')->references('id')->on('pokemon_league_trainers')->cascadeOnDelete();
            $table->unsignedBigInteger('winner_id')->nullable();
            $table->foreign('winner_id')->references('id')->on('pokemon_league_trainers')->cascadeOnDelete();
            $table->string("status")->nullable()->default("未対戦");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_league_trainer_matches');
    }
};

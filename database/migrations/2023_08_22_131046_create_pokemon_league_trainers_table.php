<?php

use App\Models\Pokemon\PokemonLeague;
use App\Models\Pokemon\PokemonTrainer;
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
        Schema::create('pokemon_league_trainers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PokemonTrainer::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PokemonLeague::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_league_trainers');
    }
};

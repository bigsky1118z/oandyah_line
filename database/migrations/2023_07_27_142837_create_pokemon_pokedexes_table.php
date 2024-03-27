<?php

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
        Schema::create('pokemon_pokedexes', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("type1")->nullable();
            $table->string("type2")->nullable();
            $table->integer("national_Pokedex_number")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_pokedexes');
    }
};

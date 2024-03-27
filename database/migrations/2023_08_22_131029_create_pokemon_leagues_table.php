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
        Schema::create('pokemon_leagues', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->date("start_date");
            $table->date("end_date");
            $table->string("rule")->nullable();
            $table->string("format")->default("シングル");
            $table->text("description")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_leagues');
    }
};

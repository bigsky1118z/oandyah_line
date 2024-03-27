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
        Schema::create('jinguji_ozora_tarot_cards', function (Blueprint $table) {
            $table->id();
            $table->string('image_url')->nullable();
            $table->string('arcana')->nullable();
            $table->string('title_jp')->nullable();
            $table->string('name_jp')->nullable();
            $table->string('number_jp')->nullable();
            $table->string('title_en')->nullable();
            $table->string('name_en')->nullable();
            $table->string('number_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jinguji_ozora_tarot_cards');
    }
};

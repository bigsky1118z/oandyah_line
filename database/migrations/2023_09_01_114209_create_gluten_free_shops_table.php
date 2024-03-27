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
        Schema::create('gluten_free_shops', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("kana")->nullable();
            $table->string("prefecture")->nullable();
            $table->string("city")->nullable();
            $table->string("town")->nullable();
            $table->string("other")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gluten_free_shops');
    }
};

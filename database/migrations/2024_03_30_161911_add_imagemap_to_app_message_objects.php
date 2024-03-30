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
        Schema::table('app_message_objects', function (Blueprint $table) {
            /** imagemap message */
            $table->longText("base_url")->nullable();
            $table->string("alt_text")->nullable();
            $table->integer("base_size_width")->nullable();
            $table->integer("base_size_height")->nullable();
            $table->json("video")->nullable();
            $table->json("actions")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_message_objects', function (Blueprint $table) {
            //
        });
    }
};

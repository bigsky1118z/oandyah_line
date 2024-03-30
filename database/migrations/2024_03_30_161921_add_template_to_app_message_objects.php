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
            /** template message */
            // $table->string("alt_text")->nullable();
            $table->json("template")->nullable();
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

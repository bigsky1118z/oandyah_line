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
            /** sticker message */
            $table->integer("package_id")->nullable();
            $table->integer("sticker_id")->nullable();
            // $table->string("quote_token")->nullable();
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

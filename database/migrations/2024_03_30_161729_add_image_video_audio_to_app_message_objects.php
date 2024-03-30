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
            /** image message */
            $table->text("original_content_url")->nullable();
            $table->text("preview_image_url")->nullable();

            /** video message */
            // $table->text("original_content_url")->nullable();
            // $table->text("preview_image_url")->nullable();
            $table->string("tracking_id")->nullable();

            /** audio message */
            // $table->text("original_content_url")->nullable();
            $table->string("duration")->nullable();
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

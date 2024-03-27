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
        Schema::create('line_api_users', function (Blueprint $table) {
            $table->id();
            $table->string('channel_name');
            $table->string('line_user_id')->nullable();
            $table->string('follow')->nullable();
            $table->string('display_name')->nullable();
            $table->string('registed_name')->nullable();
            $table->string('language')->nullable();
            $table->longText('picture_url')->nullable();
            $table->text('status_message')->nullable();
            $table->string('honorific')->nullable()->default("さん");
            $table->string('name_to_identify')->nullable();
            $table->longText('memo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_api_users');
    }
};

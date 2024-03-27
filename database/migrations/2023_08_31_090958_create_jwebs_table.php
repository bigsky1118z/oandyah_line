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
        Schema::create('jwebs', function (Blueprint $table) {
            $table->id();
            $table->string("type")->nullable();
            $table->integer("code")->nullable();
            $table->string("code1")->nullable();
            $table->string("name")->nullable();
            $table->string("artist_code")->nullable();
            $table->string("artist_name")->nullable();
            $table->string("category_code")->nullable();
            $table->dateTime("date")->nullable();
            $table->text("image_url")->nullable();
            $table->string("inbox_flag1")->nullable();
            $table->string("inbox_type")->nullable();
            $table->text("inbox_thumb")->nullable();
            $table->string("caption")->nullable();
            $table->text("link")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jwebs');
    }
};

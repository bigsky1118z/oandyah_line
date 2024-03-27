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
        Schema::create('jweb_artists', function (Blueprint $table) {
            $table->id();
            $table->string("artist_code");
            $table->string("artist_link");
            $table->string("artist_name");
            $table->string("artist_image_thumb_url");
            $table->string("artist_furigana");
            $table->string("member_code");
            $table->string("member_name");
            $table->string("member_furigana");
            $table->string("member_image_thumb_url");
            $table->string("member_date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jweb_artists');
    }
};

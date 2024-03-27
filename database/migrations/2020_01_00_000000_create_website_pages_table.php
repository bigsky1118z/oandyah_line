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
        Schema::create("website_pages", function (Blueprint $table) {
            $table->id();
            $table->string("type")->nullable();                 //single, multiple, contact, menu
            
            $table->string("path")->unique();                   //concept, news, message...
            $table->string("title")->nullable();                //概要, 最新情報, メッセージ...
            $table->text("description")->nullable();            // メニュー用タイトル(空の場合はページタイトル)

            $table->text("image_thumbnail_url")->nullable();    // https://xxxxxx.jpg, https://xxxxxx/yyyyyy.png...
            $table->text("image_header_url")->nullable();       // https://xxxxxx.jpg, https://xxxxxx/yyyyyy.png...

            
            $table->string("status")->default("draft");         //published, privated, draft...
            $table->dateTime("valid_at")->nullable();           //2023-01-01 00:00
            $table->dateTime("expired_at")->nullable();         //2023-12-31 23:59

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("website_pages");
    }
};

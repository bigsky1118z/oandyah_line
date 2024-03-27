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
        Schema::create('line_api_messages', function (Blueprint $table) {
            $table->id();
            $table->string("channel_name");
            $table->string("category")->nullable()->default("ワンタイム");
            $table->string("sub_category")->nullable();
            $table->string("name")->nullable()->default("autofill_" . (new DateTime())->format("YmdHis"));
            $table->string("status")->nullable()->default("未送信");
            $table->string("display")->nullable()->default("表示");
            $table->integer("validate_status")->nullable();
            $table->json("message")->nullable();

            $table->string("type")->nullable();
            // text
            $table->text("text")->nullable();
            $table->json("emojis")->nullable();
            // sticker
            $table->integer("package_id")->nullable();
            $table->integer("sticker_id")->nullable();
            // image, video, audio
            $table->string("original_content_url")->nullable();
            // image, video
            $table->string("preview_image_url")->nullable();
            // video
            $table->string("tracking_id")->nullable();
            // audio
            $table->integer("duration")->nullable();
            // location
            $table->string("title")->nullable();
            $table->string("address")->nullable();
            $table->decimal("latitude", 10, 7)->nullable();
            $table->decimal("longitude", 10, 7)->nullable();
            // imagemap, template, flex
            $table->string("alt_text")->nullable();
            // imagemap
            $table->string("base_url")->nullable();
            $table->json("base_size")->nullable();
            $table->json("video")->nullable();
            $table->json("actions")->nullable();
            // template
            $table->json("template")->nullable();
            // flex
            $table->json("contents")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_api_messages');
    }
};

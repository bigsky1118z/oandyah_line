<?php

use App\Models\Line\LineWebhook;
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
        Schema::create('line_webhook_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LineWebhook::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("status")->nullable();
            $table->string("type")->nullable();
            $table->string("message_id")->nullable();
            $table->string("quote_token")->nullable();
            $table->string("text")->nullable();
            $table->json("emojis")->nullable();
            $table->json("mention")->nullable();
            $table->string("content_type")->nullable();
            $table->string("content_original_url")->nullable();
            $table->string("content_preview_url")->nullable();
            $table->string("image_id")->nullable();
            $table->string("image_index")->nullable();
            $table->string("image_total")->nullable();
            $table->string("duration")->nullable();
            $table->string("file_name")->nullable();
            $table->string("file_size")->nullable();
            $table->string("title")->nullable();
            $table->string("address")->nullable();
            $table->string("latitude")->nullable();
            $table->string("longitude")->nullable();
            $table->string("sticker_id")->nullable();
            $table->string("package_id")->nullable();
            $table->string("sticker_resource_type")->nullable();
            $table->json("keywords")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_webhook_messages');
    }
};

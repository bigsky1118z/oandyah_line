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
        Schema::create('line_api_receives', function (Blueprint $table) {
            $table->id();
            $table->string("channel_name")->nullable();

            $table->string('ip_address')->nullable();
            $table->string('request_host')->nullable();
            $table->string('request_path')->nullable();
            $table->string('request_method')->nullable();
            $table->string("x_line_signature")->nullable();
            $table->integer("response_status")->nullable();

            $table->string('destination')->nullable();
            $table->string("query_string")->nullable();
            $table->string('type')->nullable();
            $table->string('mode')->nullable();
            $table->string('webhook_event_id')->nullable();
            $table->string('reply_token')->nullable();
            $table->string('line_user_id')->nullable();
            $table->string('line_group_id')->nullable();
            $table->boolean('is_redelivery')->nullable();
            $table->json('event')->nullable();
            $table->string("message")->nullable();
            $table->string("postback")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_api_receives');
    }
};

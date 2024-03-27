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
        Schema::create('line_api_replies', function (Blueprint $table) {
            $table->id();
            $table->string("channel_name");
            $table->string("name")->nullable()->default("autofill_" . (new DateTime())->format("YmdHis"));

            $table->string("type");     //  [follow, unfollow, message, postback, ...]
            $table->boolean("active")->default(false);
            $table->string("condition")->nullable();
            $table->json("messages")->nullable();
            $table->unsignedBigInteger('line_api_message_1_id')->nullable();
            $table->foreign('line_api_message_1_id')->references('id')->on('line_api_messages');
            $table->unsignedBigInteger('line_api_message_2_id')->nullable();
            $table->foreign('line_api_message_2_id')->references('id')->on('line_api_messages');
            $table->unsignedBigInteger('line_api_message_3_id')->nullable();
            $table->foreign('line_api_message_3_id')->references('id')->on('line_api_messages');
            $table->unsignedBigInteger('line_api_message_4_id')->nullable();
            $table->foreign('line_api_message_4_id')->references('id')->on('line_api_messages');
            $table->unsignedBigInteger('line_api_message_5_id')->nullable();
            $table->foreign('line_api_message_5_id')->references('id')->on('line_api_messages');
            $table->boolean('notification_disabled')->default(false);
            
            $table->dateTime("valid_at")->nullable();
            $table->dateTime("expired_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_api_replies');
    }
};

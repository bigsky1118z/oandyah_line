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
        Schema::create('line_api_sends', function (Blueprint $table) {
            $table->id();
            $table->string("channel_name")->nullable();

            $table->string("request_metod")->nullable();
            $table->string("endpoint_type")->nullable();
            $table->string("api_endpoint")->nullable();

            $table->string("status")->nullable();
            
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

            $table->boolean('notification_disabled')->nullable();
            
            $table->string("to")->nullable();
            $table->string("reply_token")->nullable();
            $table->string("custom_aggregation_units")->nullable();

            $table->string("recipient")->nullable();
            $table->string("filter")->nullable();
            $table->string("limit")->nullable();
            
            $table->integer("validate_status")->nullable();
            $table->string("validate_error_message")->nullable();
            $table->json("validate_error_details")->nullable();


            $table->integer("response_status")->nullable();
            $table->string("request_id")->nullable();
            $table->string("response_error_message")->nullable();
            $table->json("response_error_details")->nullable();

            $table->dateTime("schedule_at")->nullable();
            $table->dateTime("sent_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_api_sends');
    }
};

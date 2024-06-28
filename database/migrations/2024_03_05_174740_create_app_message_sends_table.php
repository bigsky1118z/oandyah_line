<?php

use App\Models\App\AppMessage;
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
        Schema::create('app_message_sends', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AppMessage::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->json("data");
            $table->string("friend_id")->nullable();

            $table->string("x_line_retry_key")->nullable();

            $table->string("x_line_request_id")->nullable();
            $table->json("sent_messages")->nullable();
            
            $table->dateTime("datetime")->nullable();
            $table->integer("response_code")->nullable();
            $table->text("error_message")->nullable();
            $table->json("error_details")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_message_sends');
    }
};

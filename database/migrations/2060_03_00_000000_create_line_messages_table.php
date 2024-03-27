<?php

use App\Models\Line\Line;
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
        Schema::create('line_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Line::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->string("type")->nullable();

            $table->boolean("notification_disabled")->default(false);
            $table->string("custom_aggregation_units")->nullable();
            
            $table->string("reply_token")->nullable();
            $table->string("line_user_id")->nullable();
            $table->json("line_user_ids")->nullable();
            $table->json("recipient")->nullable();
            $table->json("filter")->nullable();
            $table->json("limit")->nullable();

            $table->integer("response_status")->nullable();
            $table->json("error_message")->nullable();
            $table->json("sent_messages")->nullable();
            $table->dateTime("send_date")->nullable();
            $table->string("status")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_messages');
    }
};

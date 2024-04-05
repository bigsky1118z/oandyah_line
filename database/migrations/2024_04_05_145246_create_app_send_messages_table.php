<?php

use App\Models\App;
use App\Models\App\AppFriend;
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
        Schema::create('app_send_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("status")->default("draft");
            $table->string("type")->nullable();
            
            $table->integer("response_code")->nullable();
            $table->string("x_line_request_id")->nullable();

            $table->string("x_line_retry_key")->nullable();
    
            $table->foreignIdFor(AppFriend::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("reply_token")->nullable();
            $table->json("recipient")->nullable();
            $table->json("filter")->nullable();
            $table->json("limit")->nullable();
    
            $table->foreignIdFor(AppMessage::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
    
            $table->string("notification_disabled")->default(0);
            $table->string("custom_aggregation_units")->nullable();
    
            $table->json("sent_messages")->nullable();
            $table->string("error_message")->nullable();
            $table->json("error_details")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_send_messages');
    }
};

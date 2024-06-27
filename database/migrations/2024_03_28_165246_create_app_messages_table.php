<?php

use App\Models\App;
use App\Models\App\AppFriend;
use App\Models\App\AppReply;
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
        Schema::create('app_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("name")->nullable();
            $table->string("status")->default("draft");


            $table->string("type")->nullable();
            $table->dateTime("datetime")->nullable();
            
            /** typeごとに必要なプロパティ */
            $table->string("reply_token")->nullable();
            $table->json("push")->nullable();
            $table->json("recipient")->nullable();
            $table->json("filter")->nullable();
            $table->json("limit")->nullable();
            
            /** 送信オプション */
            $table->boolean("notification_disabled")->default(0);
            $table->string("custom_aggregation_units")->nullable();
            
            /** 本文 */
            $table->json("messages")->nullable();
            
            $table->json("error_messages")->nullable();
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

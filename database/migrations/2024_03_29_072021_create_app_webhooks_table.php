<?php

use App\Models\App;
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
        Schema::create("app_webhooks", function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("ip_address")->nullable();
            $table->string("request_host")->nullable();
            $table->string("request_path")->nullable();
            $table->string("request_method")->nullable();
            $table->longText("request_body")->nullable();
            $table->string("x_line_signature")->nullable();
            $table->integer("response_status")->nullable();
            $table->string("destination")->nullable();
            $table->string("query_string")->nullable();

            $table->string("friend_id")->nullable();
            $table->string("group_id")->nullable();
            $table->string("room_id")->nullable();

            $table->string("type")->nullable();
            $table->string("mode")->nullable();
            $table->string("webhook_event_id")->nullable();
            $table->string("reply_token")->nullable();
            $table->boolean("is_redelivery")->nullable();

            $table->json("event")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("app_webhooks");
    }
};

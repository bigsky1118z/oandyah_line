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
        Schema::create('line_api_events', function (Blueprint $table) {
            $table->id();
            $table->string("channel_name")->nullable();
            $table->string("category")->nullable();
            $table->string("sub_category")->nullable();
            $table->string("event_name")->nullable();

            $table->string("schedule_name")->nullable();
            $table->text("discription")->nullable();
            $table->string("cover_image_url")->nullable();
            $table->string("no_image_url")->nullable();
            $table->string("status")->nullable();

            $table->string("organizer")->nullable();
            $table->string("place")->nullable();
            $table->string("address")->nullable();
            $table->integer("price")->nullable();
            $table->dateTime("open_at")->nullable();
            $table->dateTime("start_at")->nullable();
            $table->dateTime("end_at")->nullable();
            $table->dateTime("close_at")->nullable();

            $table->boolean("count")->nullable()->default(true);
            $table->json("user_groups")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_api_events');
    }
};

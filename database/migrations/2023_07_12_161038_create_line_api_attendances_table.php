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
        Schema::create('line_api_attendances', function (Blueprint $table) {
            $table->id();
            $table->string("channel_name")->nullable();
            $table->string("name")->nullable();
            $table->string("section")->nullable();
            $table->date("date")->nullable();
            $table->time("open_time")->nullable();
            $table->time("start_time")->nullable();
            $table->time("end_time")->nullable();
            $table->time("close_time")->nullable();
            $table->string("place")->nullable();
            $table->integer("price")->nullable();
            $table->text("discription")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_api_attendances');
    }
};

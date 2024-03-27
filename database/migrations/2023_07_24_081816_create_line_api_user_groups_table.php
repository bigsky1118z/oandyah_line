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
        Schema::create('line_api_user_groups', function (Blueprint $table) {
            $table->id();
            $table->string("channel_name")->nullable();
            $table->string("name")->nullable();
            $table->text("description")->nullable();
            $table->boolean("active")->nullable()->default(true);
            $table->string("rank")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_api_user_groups');
    }
};

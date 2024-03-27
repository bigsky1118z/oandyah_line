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
        Schema::create('line_api_order_items', function (Blueprint $table) {
            $table->id();
            $table->string("channel_name")->nullable();
            $table->string("code")->nullable();
            $table->unique(array("channel_name","code"));
            $table->string("category")->nullable();
            $table->string("sub_category")->nullable();
            $table->string("name")->nullable();
            $table->string("size")->nullable();
            $table->json("material")->nullable();
            $table->json("allergy")->nullable();
            $table->string("square_image_url")->nullable();
            $table->string("wide_image_url")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_api_order_items');
    }
};

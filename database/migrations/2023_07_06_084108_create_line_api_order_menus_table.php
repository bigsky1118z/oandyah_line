<?php

use App\Models\Api\LineApiOrderItem;
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
        Schema::create('line_api_order_menus', function (Blueprint $table) {
            $table->id();
            $table->string("channel_name")->nullable();
            $table->string("code")->nullable();
            $table->unique(array("channel_name","code"));
            $table->string("name")->nullable();
            $table->unique(array("channel_name","name"));
            $table->string("category")->nullable();
            $table->string("sub_category")->nullable();
            $table->text("discription")->nullable();
            $table->string("cover_image_url")->nullable();
            $table->string("no_image_url")->nullable();
            $table->string("status")->nullable();
            $table->dateTime("valid_at")->nullable();
            $table->dateTime("expired_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_api_order_menus');
    }
};

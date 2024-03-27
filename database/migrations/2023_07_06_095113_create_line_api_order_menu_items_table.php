<?php

use App\Models\Api\LineApiOrderItem;
use App\Models\Api\LineApiOrderMenu;
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
        Schema::create('line_api_order_menu_items', function (Blueprint $table) {
            $table->id();
            $table->string("channel_name")->nullable();
            $table->foreignIdFor(LineApiOrderMenu::class)->nullable()->constrained();
            $table->foreignIdFor(LineApiOrderItem::class)->nullable()->constrained();
            $table->integer("price")->nullable();
            $table->decimal("tax", 3, 2)->nullable()->default(0.1);

            $table->string("code")->nullable();
            $table->string("category")->nullable();
            $table->string("sub_category")->nullable();

            $table->string("name")->nullable();
            $table->string("size")->nullable();
            $table->text("discription")->nullable();
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
        Schema::dropIfExists('line_api_order_menu_items');
    }
};

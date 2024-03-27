<?php

use App\Models\Api\LineApiOrderMenu;
use App\Models\Api\LineApiOrderMenuItem;
use App\Models\Api\LineApiUser;
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
        Schema::create('line_api_orders', function (Blueprint $table) {
            $table->id();
            $table->string("channel_name")->nullable();
            $table->foreignIdFor(LineApiOrderMenu::class)->nullable()->constrained();
            $table->foreignIdFor(LineApiUser::class)->nullable()->constrained();
            $table->string("table")->nullable();
            $table->foreignIdFor(LineApiOrderMenuItem::class)->nullable()->constrained();
            $table->integer("price")->nullable();
            $table->integer("quantity")->nullable()->default(1);
            $table->decimal("tax", 3, 2)->nullable()->default(0.1);
            $table->string("status")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_api_orders');
    }
};

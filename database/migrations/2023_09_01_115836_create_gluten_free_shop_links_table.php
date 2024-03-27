<?php

use App\Models\GlutenFree\Shop\GlutenFreeShop;
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
        Schema::create('gluten_free_shop_links', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(GlutenFreeShop::class)->constrained()->cascadeOnDelete();
            $table->string("type")->nullable();
            $table->string("name")->nullable();
            $table->text("value")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gluten_free_shop_links');
    }
};

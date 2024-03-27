<?php

use App\Models\Kbox\Product\KboxProduct;
use App\Models\Kbox\Product\KboxSemiProduct;
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
        Schema::create('kbox_product_semi_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(KboxProduct::class)->nullable()->constrained();
            $table->unsignedBigInteger('top_id')->nullable();
            $table->foreign('top_id')->references('id')->on('kbox_semi_products')->cascadeOnDelete();
            $table->unsignedBigInteger('bottom_id')->nullable();
            $table->foreign('bottom_id')->references('id')->on('kbox_semi_products')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kbox_product_semi_products');
    }
};

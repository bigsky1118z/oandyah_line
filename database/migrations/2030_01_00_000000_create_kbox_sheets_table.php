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
        Schema::create("kbox_sheets", function (Blueprint $table) {
            $table->id();
            $table->string("name");                                     // KIボール
            $table->string("color");                                    // 茶
            $table->unsignedBigInteger('supplier_id')->nullable();      // 伊藤忠紙パルプ商事
            $table->foreign('supplier_id')->references('id')->on('kbox_companies')->cascadeOnDelete();
            $table->unsignedBigInteger('manufacturer_id')->nullable();  // 大和板紙
            $table->foreign('manufacturer_id')->references('id')->on('kbox_companies')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("kbox_sheets");
    }
};

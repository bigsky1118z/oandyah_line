<?php

use App\Models\Kbox\Sheet\KboxSheet;
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
        Schema::create('kbox_sheet_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(KboxSheet::class)->constrained();
            $table->decimal("purchase")->nullable();        // 133(yen)
            $table->decimal("subcontractor")->nullable();   // 150(yen)
            $table->decimal("estimate")->nullable();        // 152(yen)
            $table->date("valid_at")->nullable();           // 0000-00-00～
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kbox_sheet_prices');
    }
};

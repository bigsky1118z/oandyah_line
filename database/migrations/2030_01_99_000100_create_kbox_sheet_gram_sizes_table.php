<?php

use App\Models\Kbox\Sheet\KboxSheetGram;
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
        Schema::create('kbox_sheet_gram_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(KboxSheetGram::class)->constrained();
            $table->decimal("length");  // 800(mm)
            $table->decimal("width");   // 1100(mm)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kbox_sheet_gram_sizes');
    }
};

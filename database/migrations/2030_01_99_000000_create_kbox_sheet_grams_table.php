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
        Schema::create('kbox_sheet_grams', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(KboxSheet::class)->constrained();
            $table->decimal("gram");    // 420(g)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kbox_sheet_grams');
    }
};

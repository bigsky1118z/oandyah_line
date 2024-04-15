<?php

use App\Models\App\AppAuto;
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
        Schema::create('app_auto_defaults', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AppAuto::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("type");
            $table->unique(["app_auto_id","type"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_auto_defaults');
    }
};

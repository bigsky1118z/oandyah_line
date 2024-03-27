<?php

use App\Models\Line\Line;
use App\Models\Line\LineFriend;
use App\Models\Line\LineGroup;
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
        Schema::create('line_group_friends', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Line::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(LineGroup::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(LineFriend::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_group_friends');
    }
};

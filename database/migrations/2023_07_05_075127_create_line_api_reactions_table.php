<?php

use App\Models\Api\LineApiReceive;
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
        Schema::create('line_api_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LineApiReceive::class)->constrained();
            $table->string("channel_name");
            $table->string("reaction")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_api_reactions');
    }
};

<?php

use App\Models\Sns\Sns;
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
        Schema::create('sns_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sns::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("name");
            $table->string("value")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sns_configs');
    }
};

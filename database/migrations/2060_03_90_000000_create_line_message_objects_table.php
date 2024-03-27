<?php

use App\Models\Line\LineMessage;
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
        Schema::create('line_message_objects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LineMessage::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer("index")->nullable();
            $table->string("type")->nullable();
            $table->integer("line_message_type_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_message_objects');
    }
};

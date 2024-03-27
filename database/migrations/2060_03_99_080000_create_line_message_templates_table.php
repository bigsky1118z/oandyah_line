<?php

use App\Models\Line\Line;
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
        Schema::create('line_message_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Line::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("name")->nullable();
            
            $table->string("status")->nullable();
            $table->string("validate")->nullable();

            $table->string("alt_text")->nullable();
            $table->string("type")->nullable();
            $table->integer("line_message_template_type_id")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_message_templates');
    }
};

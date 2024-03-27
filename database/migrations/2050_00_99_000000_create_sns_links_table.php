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
        Schema::create('sns_links', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sns::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("type")->nullable();
            $table->string("title")->nullable();
            $table->text("value")->nullable();
            $table->text("description")->nullable();
            $table->text("image_url_thumbnail")->nullable();
            $table->text("image_url_header")->nullable();
            $table->boolean("active")->nullable();
            $table->integer("order")->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sns_links');
    }
};

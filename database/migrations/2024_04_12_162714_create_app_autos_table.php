<?php

use App\Models\App;
use App\Models\App\AppMessage;
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
        Schema::create('app_autos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("type")->nullable();
            $table->string("name")->nullable();
            $table->json("condition")->nullable();
            $table->integer("priority")->nullable();
            $table->foreignIdFor(AppMessage::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean("enable")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_autos');
    }
};

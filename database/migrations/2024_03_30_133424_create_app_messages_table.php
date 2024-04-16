<?php

use App\Models\App;
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
        Schema::create('app_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("name")->nullable();
            $table->string("status")->nullable();
            $table->json("messages")->nullable();
            
            $table->json("condition")->nullable();
            $table->integer("priority")->nullable();
            $table->boolean("enable")->default(true);
            $table->boolean("default")->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_messages');
    }
};

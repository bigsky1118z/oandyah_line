<?php

use App\Models\User;
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
        Schema::create('user_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->namespace()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("key");
            $table->unique(['user_id', 'key']);
            $table->text("value")->nullable();
            $table->text("description")->nullable();
            $table->boolean("enable")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_configs');
    }
};

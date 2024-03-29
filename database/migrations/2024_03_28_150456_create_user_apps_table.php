<?php

use App\Models\App;
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
        Schema::create('user_apps', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->namespace()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(App::class)->namespace()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unique(["user_id","app_id"]);
            $table->string("role")->default("editor");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_apps');
    }
};

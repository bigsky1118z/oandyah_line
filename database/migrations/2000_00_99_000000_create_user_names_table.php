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
        Schema::create('user_names', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("last_name_jp")->nullable();
            $table->string("last_name_kana")->nullable();
            $table->string("last_name_en")->nullable();
            $table->string("middle_name_jp")->nullable();
            $table->string("middle_name_kana")->nullable();
            $table->string("middle_name_en")->nullable();
            $table->string("first_name_jp")->nullable();
            $table->string("first_name_kana")->nullable();
            $table->string("first_name_en")->nullable();
            $table->string("maiden_name_jp")->nullable();
            $table->string("maiden_name_kana")->nullable();
            $table->string("maiden_name_en")->nullable();

            $table->string("nickname")->nullable();
            $table->string("naming")->nullable();

            $table->string("honorific_title")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_names');
    }
};

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
        Schema::create('apps', function (Blueprint $table) {
            $table->id();            
            $table->string("name")->unique();
            $table->string("channel_access_token")->unique();
            $table->string("channel_secret");

            $table->string("user_id")->nullable();
            $table->string("basic_id")->nullable();
            $table->string("display_name")->nullable();
            $table->text("picture_url")->nullable();
            $table->string("chat_mode")->nullable();
            $table->string("mark_as_read_mode")->nullable();
            $table->string("status")->default("active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apps');
    }
};

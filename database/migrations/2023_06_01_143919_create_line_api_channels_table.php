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
        Schema::create('line_api_channels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained();
            $table->string("channel_name")->unique();
            $table->string("access_token")->unique();
            $table->string("bot_user_id")->nullable();
            $table->string("display_name")->nullable();
            $table->string("basic_id")->nullable();
            $table->string("premium_id")->nullable();
            $table->string("picture_url")->nullable();
            $table->string("chat_mode")->nullable();
            $table->string("mark_as_read_mode")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_api_channels');
    }
};

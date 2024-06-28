<?php

use App\Models\App\AppReply;
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
        Schema::create('app_reply_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AppReply::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->json("messages")->nullable();
            $table->string("status")->default("active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_reply_messages');
    }
};

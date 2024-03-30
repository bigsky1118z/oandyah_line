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
        Schema::create('app_friends', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App::class)->namespace()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("friend_id")->unique();
            $table->string("status")->nullable();
            $table->string("display_name")->nullable();
            $table->string("language")->nullable();
            $table->string("picture_url")->nullable();
            $table->string("status_message")->nullable();
            
            $table->string("naming")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_users');
    }
};

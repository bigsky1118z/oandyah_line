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
        Schema::create('app_richmenus', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App::class)->namespace()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("richmenu_id")->nullable();
            $table->string("name")->nullable();
            $table->string("chat_bar_text")->nullable();
            $table->boolean("selected")->default(true);
            $table->json("size")->nullable();
            $table->json("areas")->nullable();
            $table->string("status")->default("draft");
            $table->json("error_messages")->nullable();
            $table->json("error_details")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_richmenus');
    }
};

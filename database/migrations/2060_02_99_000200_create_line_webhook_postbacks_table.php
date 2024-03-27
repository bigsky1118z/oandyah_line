<?php

use App\Models\Line\LineWebhook;
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
        Schema::create('line_webhook_postbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LineWebhook::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("status")->nullable();
            $table->string("data")->nullable();
            $table->string("new_rich_menu_alias_id")->nullable();
            $table->string("rich_menu_switch_status")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_webhook_postbacks');
    }
};

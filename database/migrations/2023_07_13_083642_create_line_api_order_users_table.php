<?php

use App\Models\Api\LineApiOrderMenu;
use App\Models\Api\LineApiUser;
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
        Schema::create('line_api_order_users', function (Blueprint $table) {
            $table->id();
            $table->string("channel_name")->nullable();
            $table->foreignIdFor(LineApiOrderMenu::class)->nullable()->constrained();
            $table->foreignIdFor(LineApiUser::class)->nullable()->constrained();
            $table->string("name")->nullable();
            $table->string("value")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_api_order_users');
    }
};

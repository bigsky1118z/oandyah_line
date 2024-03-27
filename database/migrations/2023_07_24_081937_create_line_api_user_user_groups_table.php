<?php

use App\Models\Api\LineApiUser;
use App\Models\Api\LineApiUserGroup;
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
        Schema::create('line_api_user_user_groups', function (Blueprint $table) {
            $table->id();
            $table->string("channel_name")->nullable();
            $table->foreignIdFor(LineApiUser::class)->nullable()->constrained();
            $table->foreignIdFor(LineApiUserGroup::class)->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_api_user_user_groups');
    }
};

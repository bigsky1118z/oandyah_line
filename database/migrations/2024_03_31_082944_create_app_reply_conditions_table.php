<?php

use App\Models\App;
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
        Schema::create('app_reply_conditions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(AppReply::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("type");

            $table->json("condition")->default(array());
            $table->integer("priority")->nullable();
            $table->boolean("enable")->default(true);
            $table->boolean("default")->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_reply_conditions');
    }
};

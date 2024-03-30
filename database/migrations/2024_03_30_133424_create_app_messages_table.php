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
        Schema::create('app_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("status")->nullable();
            
            $table->unsignedBigInteger('app_message_object_1_id')->nullable();
            $table->foreign('app_message_object_1_id')->references('id')->on('app_message_objects');
            $table->unsignedBigInteger('app_message_object_2_id')->nullable();
            $table->foreign('app_message_object_2_id')->references('id')->on('app_message_objects');
            $table->unsignedBigInteger('app_message_object_3_id')->nullable();
            $table->foreign('app_message_object_3_id')->references('id')->on('app_message_objects');
            $table->unsignedBigInteger('app_message_object_4_id')->nullable();
            $table->foreign('app_message_object_4_id')->references('id')->on('app_message_objects');
            $table->unsignedBigInteger('app_message_object_5_id')->nullable();
            $table->foreign('app_message_object_5_id')->references('id')->on('app_message_objects');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_messages');
    }
};

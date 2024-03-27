<?php

use App\Models\Website\WebsitePage;
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
        Schema::create('website_page_singles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WebsitePage::class)->unique()->constrained()->cascadeOnDelete();
            $table->longText('body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_page_singles');
    }
};

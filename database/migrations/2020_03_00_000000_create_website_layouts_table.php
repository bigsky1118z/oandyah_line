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
        Schema::create('website_layouts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WebsitePage::class)->constrained()->cascadeOnDelete();
            $table->string("type")->nullable();     // top, single...
            $table->string("target")->nullable();   // header, main, footer...
            $table->integer("order")->nullable();   // 1, 2, 3...
            $table->string("option")->nullable();   // default, article-3, article-new...
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_top_layouts');
    }
};

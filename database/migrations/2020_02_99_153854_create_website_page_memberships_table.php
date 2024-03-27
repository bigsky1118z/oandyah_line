<?php

use App\Models\Website\WebsiteMembership;
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
        Schema::create('website_page_memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WebsitePage::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(WebsiteMembership::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_page_memberships');
    }
};

<?php

use App\Models\Website\Page\WebsitePageMultiple;
use App\Models\Website\WebsiteMembership;
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
        Schema::create('website_page_multiple_memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WebsitePageMultiple::class)->constrained()->cascadeOnDelete()->name('website_page_multiple_id');
            $table->foreignIdFor(WebsiteMembership::class)->constrained()->cascadeOnDelete()->name('website_membership_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_page_multiple_memberships');
    }
};

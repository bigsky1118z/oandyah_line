<?php

use App\Models\Website\Page\WebsitePageContact;
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
        Schema::create('website_page_contact_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WebsitePageContact::class)->constrained()->cascadeOnDelete();
            $table->json("values")->nullable();
            $table->string("status")->nullable()->default("pending");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_page_contact_posts');
    }
};

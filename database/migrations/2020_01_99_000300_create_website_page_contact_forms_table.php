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
        Schema::create('website_page_contact_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WebsitePageContact::class)->constrained()->cascadeOnDelete();
            $table->boolean("active")->default(false);
            $table->string("name")->nullable();
            $table->string("title")->nullable();
            $table->string("type")->nullable();
            $table->boolean("required")->default(false);
            $table->text("description")->nullable();
            $table->integer("order")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_page_contact_forms');
    }
};

<?php

use App\Models\Website\Page\WebsitePageMultiple;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_page_multiple_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WebsitePageMultiple::class)->constrained()->cascadeOnDelete();
            $table->string('path')->unique()->default(strtolower(Str::random(10))); //greeting
            $table->string("title")->nullable();                                    //こんにちは！
            $table->longText('body')->nullable();                                   //宜しくお願いします！

            $table->text("image_thumbnail_url")->nullable();                        // https://xxxxxx.jpg, https://xxxxxx/yyyyyy.png...
            $table->text("image_header_url")->nullable();                           // https://xxxxxx.jpg, https://xxxxxx/yyyyyy.png...

            $table->string("status")->default("published");                         //published, privated, draft...
            $table->dateTime("valid_at")->nullable();                               //2023-01-01 00:00
            $table->dateTime("expired_at")->nullable();                             //2023-12-31 23:59

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_page_multiple_articles');
    }
};

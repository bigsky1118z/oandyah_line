<?php

use App\Models\Website\Page\WebsitePageMenu;
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
        Schema::create('website_page_menu_links', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WebsitePageMenu::class)->constrained()->cascadeOnDelete();
            $table->string("path")->nullable();                 // #body, /, https://google.com...
            $table->string("title")->nullable();                // メニュー用タイトル(空の場合はページタイトル)
            $table->text("description")->nullable();            // メニュー用タイトル(空の場合はページタイトル)
            $table->text("image_thumbnail_url")->nullable();    // https://xxxxxx.jpg, https://xxxxxx/yyyyyy.png...
            $table->integer("order")->nullable();               // menuの並び順


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_page_menu_links');
    }
};

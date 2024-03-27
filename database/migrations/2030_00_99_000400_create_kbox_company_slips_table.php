<?php

use App\Models\Kbox\Company\KboxCompany;
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
        Schema::create("kbox_company_slips", function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(KboxCompany::class)->constrained();
            $table->string("type")->nullable()->default("通常伝票");
            $table->boolean("price")->nullable()->default(true);
            $table->boolean("total")->nullable()->default(true);
            $table->text("description")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        KboxCompany::backup_csv("kbox_company_slips");
        Schema::dropIfExists("kbox_company_slips");
    }
};

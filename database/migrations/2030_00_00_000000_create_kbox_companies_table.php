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
        Schema::create('kbox_companies', function (Blueprint $table) {
            $table->id();
            $table->string("category")->nullable();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('kana')->nullable();
            $table->string("company_type")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        KboxCompany::backup_csv("kbox_companies");
        Schema::dropIfExists('kbox_companies');
    }
};

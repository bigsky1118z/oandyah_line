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
        Schema::create('kbox_company_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(KboxCompany::class)->constrained();
            $table->string("type");
            $table->string("zip_code")->nullable();
            $table->string("prefecture")->nullable();
            $table->string("city")->nullable();
            $table->string("town")->nullable();
            $table->string("other")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        KboxCompany::backup_csv("kbox_company_addresses");
        Schema::dropIfExists('kbox_company_addresses');
    }
};

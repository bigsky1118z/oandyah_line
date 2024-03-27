<?php

use App\Models\Kbox\Company\KboxCompany;
use App\Models\Kbox\Company\KboxCompanyAddress;
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
        Schema::create("kbox_company_billings", function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(KboxCompany::class)->constrained();
            $table->foreignIdFor(KboxCompanyAddress::class)->constrained();
            $table->integer("closing_date")->default(0);
            $table->integer("payment_date")->default(0);
            $table->integer("payment_month")->default(0);
            $table->text("description")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        KboxCompany::backup_csv("kbox_company_billings");
        Schema::dropIfExists("kbox_company_billings");
    }
};

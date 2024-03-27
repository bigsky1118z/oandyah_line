<?php

use App\Models\Kbox\Company\KboxCompany;
use App\Models\Kbox\Sheet\KboxSheet;
use App\Models\Kbox\Sheet\KboxSheetGram;
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
        Schema::create('kbox_products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('type')->nullable();

            $table->foreignIdFor(KboxCompany::class)->nullable()->constrained();
            $table->string('name')->nullable();
            $table->string("classification")->nullable();
            $table->string('extra')->nullable();
            $table->string('color')->nullable();
            
            $table->text("description")->nullable();

            $table->foreignIdFor(KboxSheetGram::class)->nullable()->constrained();

            $table->decimal('length')->nullable();
            $table->decimal('width')->nullable();
            $table->decimal('height')->nullable();
            $table->decimal('low_top')->nullable();
            
            $table->string('assemble')->nullable();
            $table->string('cutting')->nullable();
            $table->string('processing')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kbox_products');
    }
};

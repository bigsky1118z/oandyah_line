<?php

use App\Models\Webapp\Company;
use App\Models\Webapp\Product;
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
        Schema::create('company_provide_products', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(Company::class)->constrained();
            // $table->foreignIdFor(Product::class)->constrained();
            $table->string("name")->nullable();
            $table->decimal('price')->nullable();
            $table->integer('quantity')->default(1);
            $table->string("status")->nullable();
            $table->string("delivery")->default("配送");
            $table->integer('leadtime')->nullable();
            $table->dateTime('start_date')->default(date('Y-m-d H:i:s'));
            $table->dateTime('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_provide_products');
    }
};

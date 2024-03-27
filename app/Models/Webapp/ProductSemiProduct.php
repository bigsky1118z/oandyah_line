<?php

namespace App\Models\Webapp;

use App\Models\Webapp\Product;
use App\Models\Webapp\SemiProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSemiProduct extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function semi_product()
    {
        return $this->belongsTo(SemiProduct::class);
    }
}

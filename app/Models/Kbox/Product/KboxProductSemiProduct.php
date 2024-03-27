<?php

namespace App\Models\Kbox\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KboxProductSemiProduct extends Model
{
    use HasFactory;

    function product()
    {
        return $this->belongsTo(KboxProduct::class,"kbox_product_id");
    }

    function top()
    {
        return $this->belongsTo(KboxSemiProduct::class,"top_id");
    }

    function bottom()
    {
        return $this->belongsTo(KboxSemiProduct::class,"bottom_id");
    }

}

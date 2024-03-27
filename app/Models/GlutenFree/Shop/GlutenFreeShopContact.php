<?php

namespace App\Models\GlutenFree\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlutenFreeShopContact extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "gluten_free_shop_id",
        "type",
        "name",
        "value",
    );
}

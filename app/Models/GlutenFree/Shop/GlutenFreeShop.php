<?php

namespace App\Models\GlutenFree\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlutenFreeShop extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "name",
        "kana",
        "prefecture",
        "city",
        "town",
        "other",
    );

    public function full_address()
    {
        return $this->prefecture . $this->city . $this->town . $this->other;
    }

    public function contacts()
    {
        return $this->hasMany(GlutenFreeShopContact::class, "gluten_free_shop_id");
    }

    public function set_contact($type, $name, $value)
    {
        
        GlutenFreeShopContact::updateOrCreate(
            array(
                "gluten_free_shop_id"   =>  $this->id,
                "type"                  =>  $type,
                "name"                  =>  $name,
            ),
            array(
                "value" =>  $value,
            )
        );
    }

    public function links()
    {
        return $this->hasMany(GlutenFreeShopLink::class, "gluten_free_shop_id");
    }

    public function set_link($type, $name, $value)
    {
        
        GlutenFreeShopLink::updateOrCreate(
            array(
                "gluten_free_shop_id"   =>  $this->id,
                "type"                  =>  $type,
                "name"                  =>  $name,
            ),
            array(
                "value" =>  $value,
            )
        );
    }


}

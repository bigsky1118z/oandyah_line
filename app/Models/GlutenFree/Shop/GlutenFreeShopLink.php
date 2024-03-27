<?php

namespace App\Models\GlutenFree\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlutenFreeShopLink extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "gluten_free_shop_id",
        "type",
        "name",
        "value",
    );

    public function url()
    {
        switch($this->type){
            case "instagram":
                return "https://www.instagram.com/" . $this->value;
                break;
                case "facebook":
                    return "https://www.facebook.com/" . $this->value;
                    break;
            case "facebook":
                return "https://www.facebook.com/" . $this->value;
                break;
            case "facebook":
                return "https://www.facebook.com/" . $this->value;
                break;
            case "facebook":
                return "https://www.facebook.com/" . $this->value;
                break;
            default:
                return $this->value;

        }
    }
}

<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineApiOrderMenu extends Model
{
    use HasFactory;
    protected $fillable =   array(
        "channel_name",
        "code",
        "name",
        "category",
        "sub_category",
        "discription",
        "cover_image_url",
        "no_image_url",
        "status",
        "valid_at",
        "expired_at",
    );

    public function line_api_order_item()
    {
        return $this->belongsTo(LineApiOrderItem::class)->where(function($query){
            $query->where("channel_name", $this->channel_name)
                ->orWhere("channel_name", "all");
        });
    }

    public function item_name()
    {
        $item_name  =   "";
        $this->line_api_order_item ? $item_name = $this->line_api_order_item->name : null;
        $this->display_name ? $item_name = $this->display_name : null;
        return  $item_name;
    }
}

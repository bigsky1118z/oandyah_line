<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineApiOrderMenuItem extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "channel_name",
        "line_api_order_menu",
        "line_api_order_item",
        "price",
        "code",
        "category",
        "sub_category",
        "name",
        "size",
        "discription",
        "square_image_url",
        "wide_image_url",
    );

    public function line_api_order_menu()
    {
        return $this->belongsTo(LineApiOrderMenu::class)->whereChannelName($this->channel_name);
    }

    public function line_api_order_item()
    {
        return $this->belongsTo(LineApiOrderItem::class)->whereChannelName($this->channel_name);
    }

    public function display_name(){
        $display_name   =   "---";
        $display_name   =   $this->line_api_order_item ? $this->line_api_order_item->name : $display_name;
        $display_name   =   $this->name ? $this->name : $display_name;
        return $display_name;
    }
}

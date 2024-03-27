<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\returnValue;

class LineApiOrder extends Model
{
    use HasFactory;
    
    protected $fillable   =   array(
        "channel_name",
        "line_api_order_menu_id",
        "line_api_user_id",
        "table",
        "line_api_order_menu_item_id",
        "price",
        "quantity",
        "status",
    );

    public function line_api_order_menu()
    {
        return $this->belongsTo(LineApiOrderMenu::class)->where("channel_name",$this->channel_name);
    }

    public function line_api_user()
    {
        return $this->belongsTo(LineApiUser::class)->where("channel_name",$this->channel_name);
    }

    public function line_api_order_menu_item()
    {
        return $this->belongsTo(LineApiOrderMenuItem::class)->where("channel_name",$this->channel_name);
    }


    public function get_line_api_order_user($name = null)
    {
        $line_api_order_menu    =   $this->line_api_order_menu;
        $line_api_user          =   $this->line_api_user;
        if($line_api_order_menu && $line_api_user){
            $line_api_order_user    =   LineApiOrderUser::whereLineApiOrderMenuId($line_api_order_menu->id)->whereLineApiUserId($line_api_user->id);
            if(is_null($name)){
                return $line_api_order_user->get();
            } elseif(!is_null($name)){
                return $line_api_order_user->where("name",$name)->first()->value;
            }
        } else {
            return null;
        }
        
    }
}
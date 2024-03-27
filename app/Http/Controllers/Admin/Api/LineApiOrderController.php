<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\LineApiChannel;
use App\Models\Api\LineApiOrder;
use App\Models\Api\LineApiOrderMenu;
use App\Models\Api\LineApiReceive;
use App\Models\Api\LineApiReply;
use App\Models\Api\LineApiUser;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Line;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnValueMap;

class LineApiOrderController extends Controller
{
    public function index($channel_name)
    {
        $data   =   array(
            "channel"               =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "line_api_order_menus"  =>  LineApiOrderMenu::whereChannelName($channel_name)->get(),
            "postbacks"             =>  LineApiReceive::whereChannelName($channel_name)->whereType("postback")->where("postback","like","%action=order%")->get(),
        );
        return view("admin.api.line.order.index", $data);
    }

    public function name($channel_name, $name)
    {
        $line_api_order_menu    =   LineApiOrderMenu::whereChannelName($channel_name)->whereName($name)->first();
        if($line_api_order_menu){
            $data   =   array(
                "channel"           =>  LineApiChannel::whereChannelName($channel_name)->first(),
                "name"              =>  $name,
                "grouped_orders"    =>  array(
                    "未提供"        =>  LineApiOrder::whereChannelName($channel_name)->whereLineApiOrderMenuId($line_api_order_menu->id)->whereStatus("未提供")->get(),
                    "提供済"        =>  LineApiOrder::whereChannelName($channel_name)->whereLineApiOrderMenuId($line_api_order_menu->id)->whereStatus("提供済")->get(),
                    "キャンセル"    =>  LineApiOrder::whereChannelName($channel_name)->whereLineApiOrderMenuId($line_api_order_menu->id)->whereStatus("キャンセル")->get(),
                ),
                "postbacks"         =>  LineApiReceive::whereChannelName($channel_name)->whereType("postback")->whereNotNull("postback")->where("postback", "like", "%action=order%")->where("postback", "like", "%menu=$line_api_order_menu->id%")->where("postback", "like", "%value=order%")->get(),
            );
            return view("admin.api.line.order.order", $data);
        } else {
            return back();
        }
    }


    public function users($channel_name, $name)
    {
        $line_api_order_menu    =   LineApiOrderMenu::whereChannelName($channel_name)->whereName($name)->first();
        if($line_api_order_menu){
            $data   =   array(
                "channel"           =>  LineApiChannel::whereChannelName($channel_name)->first(),
                "name"              =>  $name,
                "grouped_orders"    =>  LineApiOrder::whereChannelName($channel_name)->whereLineApiOrderMenuId($line_api_order_menu->id)->whereIn("status",["未提供","提供済","キャンセル"])->get()->groupBy("line_api_user_id"),
            );
            return view("admin.api.line.order.users", $data);
        } else {
            return back();
        }
    }


    public function user($channel_name, $name, $line_api_user_id)
    {
        $line_api_order_menu    =   LineApiOrderMenu::whereChannelName($channel_name)->whereName($name)->first();
        if($line_api_order_menu){
            $data   =   array(
                "channel"           =>  LineApiChannel::whereChannelName($channel_name)->first(),
                "name"              =>  $name,
                "line_api_user"     =>  LineApiUser::find($line_api_user_id),
                "grouped_orders"    =>  array(
                    "ご注文"        =>  LineApiOrder::whereChannelName($channel_name)->whereLineApiOrderMenuId($line_api_order_menu->id)->whereLineApiUserId($line_api_user_id)->whereIn("status",array("未提供","提供済"))->get(),
                    "キャンセル"    =>  LineApiOrder::whereChannelName($channel_name)->whereLineApiOrderMenuId($line_api_order_menu->id)->whereLineApiUserId($line_api_user_id)->whereIn("status",array("キャンセル"))->get(),
                ),
            );
            return view("admin.api.line.order.user", $data);
        } else {
            return back();
        }

    }

    public function all(Request $request, $channel_name, $name)
    {
        $line_api_order_menu    =   LineApiOrderMenu::whereChannelName($channel_name)->whereName($name)->first();
        if($line_api_order_menu){
            $orders     =   LineApiOrder::whereChannelName($channel_name)->whereLineApiOrderMenuId($line_api_order_menu->id);
            $from       =   $request->get("from");
            $to         =   $request->get("to");
            $status     =   $request->get("status");
            $groupBy    =   $request->get("groupBy");
            if(isset($from["date"])){
                list($from_year, $from_month, $from_day)  =   explode("-", $from["date"]);
                $from_time  =   isset($from["time"]) ? (int) $from["time"] : 0;
                $orders->where("created_at",">=",date("Y-m-d H:i:s",mktime($from_time,0,0,$from_month,$from_day,$from_year)));
            }
            if(isset($to["date"])){
                list($to_year, $to_month, $to_day)  =   explode("-", $to["date"]);
                $to_time  =   isset($to["time"]) ? (int) $to["time"] : 0;
                $orders->where("created_at","<=",date("Y-m-d H:i:s",mktime($to_time,59,59,$to_month,$to_day,$to_year)));
            }
            if(!empty($status)){
                $orders->where(function($query) use ($status) {
                    isset($status["delivered"]) ? $query->orWhere("status","提供済") : null;
                    isset($status["ordered"]) ? $query->orWhere("status","未提供") : null;
                    isset($status["cancel"]) ? $query->orWhere("status","キャンセル") : null;
                    isset($status["paid"]) ? $query->orWhere("status","like","会計済%") : null;
                });
            }
            $orders =   $orders->get();
            if(!empty($groupBy)){
                $orders =   $orders->groupBy($groupBy);
            }
            $data   =   array(
                "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
                "name"      =>  $name,
                "orders"    =>  $orders,
                "from"      =>  $from,
                "to"        =>  $to,
                "status"    =>  $status,
                "groupBy"   =>  $groupBy,
            );
            return view("admin.api.line.order.all", $data);
        } else {
            return back()->withInput();
        }
    }

    public function update_status($channel_name, $name, $id, $status)
    {
        $line_api_order_menu    =   LineApiOrderMenu::whereChannelName($channel_name)->whereName($name)->first();
        if($line_api_order_menu){
            $statuses =   array(
                "delivered" =>  "提供済",
                "ordered"   =>  "未提供",
                "cancel"    =>  "キャンセル",
                "paid"      =>  "会計済[" . date("Y-m-d H:i:s") . "]",
            );
            switch($status){
                case("delivered") :
                case("ordered") :
                case("cancel") :
                    $line_api_order =   LineApiOrder::whereChannelName($channel_name)->whereLineApiOrderMenuId($line_api_order_menu->id)->whereId($id)->first();
                    if($line_api_order){
                        isset($statuses[$status]) ? $line_api_order->status = $statuses[$status] : null;
                        $line_api_order->save();
                    }
                    break;
                case("paid") :
                    $line_api_orders    =   LineApiOrder::whereChannelName($channel_name)->whereLineApiOrderMenuId($line_api_order_menu->id)->whereLineApiUserId($id)->whereIn("status",["未提供","提供済","キャンセル"])->get();
                    foreach($line_api_orders as $line_api_order){
                        if($line_api_order->status == "キャンセル"){
                            $line_api_order->quantity  =  0;
                        }
                        isset($statuses[$status]) ? $line_api_order->status = $statuses[$status] : null;
                        $line_api_order->save();
                    }
                    break;
            }
        }
        return back();
    }


    /** postback */

    public function reply_index($channel_name)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "replies"   =>  LineApiReply::whereChannelName($channel_name)->whereType("postback")->where("condition","like","%action=order%")->orderByDesc("updated_at")->get(),
            "menus"     =>  LineApiOrderMenu::whereChannelName($channel_name)->get(),
        );
        return view("admin.api.line.reply.postback.order.index", $data);
    }

    public function reply_menu($channel_name, $id)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "replies"   =>  LineApiReply::whereChannelName($channel_name)->whereType("postback")->where("condition","like","%action=order%")->orderByDesc("updated_at")->get(),
            "menus"     =>  LineApiOrderMenu::whereChannelName($channel_name)->get(),
        );
        return view("admin.api.line.reply.postback.order.menu", $data);
    }


    public function reply_list($channel_name, $id)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
        );
        return view("admin.api.line.reply.postback.order.list", $data);
    }

    public function reply_confirm($channel_name, $id)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
        );
        return view("admin.api.line.reply.postback.order.confirm", $data);
    }

    public function reply_order($channel_name, $id)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
        );
        return view("admin.api.line.reply.postback.order.order", $data);
    }

}

// channel_name
// LineApiOrderMenu
// LineApiOrderItem
// price
// tax
// code
// category
// sub_category
// name
// size
// discription
// square_image_url
// wide_image_url
<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\LineApiChannel;
use App\Models\Api\LineApiOrderItem;
use App\Models\Api\LineApiOrderMenu;
use Illuminate\Http\Request;

class LineApiOrderMenuController extends Controller
{
    public function index($channel_name)
    {
        $data   =   array(
            "channel"       =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "grouped_menus" =>  LineApiOrderMenu::whereChannelName($channel_name)->get()->groupBy("group"),
        );
        return view("admin.api.line.order.menu.index", $data);
    }

    public function create($channel_name)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
        );
        return view("admin.api.line.order.menu.create", $data);
    }

    public function store(Request $request, $channel_name)
    {
        $group  =   $request->get("group");
        if($group){
            if(!LineApiOrderMenu::whereChannelName($channel_name)->whereGroup($group)->exists()){
                foreach(range(1,2) as $number){
                    $menu   =   new LineApiOrderMenu(array(
                        "channel_name"              =>  $channel_name,
                        "group"                     =>  $group,
                        "category"                  =>  "price",
                        "line_api_order_item_id"    =>  $number,
                        "price"                     =>  0,
                        "status"                    =>  "有効",
                    ));
                    $menu->save();    
                }
            }
            return redirect("/api/line/$channel_name/order/menu/$group/item");
        }else{
            return back();
        }
    }

    public function edit($channel_name, $group)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "group"     =>  LineApiOrderMenu::whereChannelName($channel_name)->whereGroup($group)->exists() ? $group : null,
        );
        return view("admin.api.line.order.menu.create", $data);
    }

    public function update(Request $request, $channel_name, $group)
    {
        $menus  =   LineApiOrderMenu::whereChannelName($channel_name)->whereGroup($group)->get();
        if($menus->isNotEmpty()){
            $new_group  =   $request->get("group");
            if(!LineApiOrderMenu::whereChannelName($channel_name)->whereGroup($new_group)->exists()){
                $menus->each(function($menu)use($new_group){
                    $menu->group    =   $new_group;
                    $menu->save();
                });
            }
        }
        return redirect("/api/line/$channel_name/order/menu/$group/item");
    }

    public function delete($channel_name, $group)
    {
        $menus   =   LineApiOrderMenu::whereGroup($group)->whereChannelName($channel_name)->get();
        $menus->isNotEmpty() ? $menus->each(fn($menu)=>$menu->delete()) : null;
        return redirect("/api/line/$channel_name/order/menu");
    }

    public function item ($channel_name, $group)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "group"     =>  LineApiOrderMenu::whereChannelName($channel_name)->whereGroup($group)->exists() ? $group : null,
            "menus"     =>  LineApiOrderMenu::whereChannelName($channel_name)->whereGroup($group)->orderBy("category")->get(),
        );
        return view("admin.api.line.order.menu.item.index", $data);
    }
    public function item_create ($channel_name, $group)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "group"     =>  LineApiOrderMenu::whereChannelName($channel_name)->whereGroup($group)->exists() ? $group : null,
            "items"     =>  LineApiOrderItem::whereIn("channel_name",array($channel_name,"all"))->orderBy("category")->get(),
        );
        return view("admin.api.line.order.menu.item.create", $data);
    }
    public function item_store (Request $request, $channel_name, $group)
    {
        $menu   =   new LineApiOrderMenu(array(
            "channel_name"              =>  $channel_name,
            "group"                     =>  $group,
            "line_api_order_item_id"    =>  $request->has("line_api_order_item_id") ? $request->get("line_api_order_item_id") : null,
            "display_name"              =>  $request->has("display_name") ? $request->get("display_name") : null,
            "category"                  =>  $request->has("category") ? $request->get("category") : null,
            "sub_category"              =>  $request->has("sub_category") ? $request->get("sub_category") : null,
            "price"                     =>  $request->has("price") ? $request->get("price") : null,
            "discription"               =>  $request->has("discription") ? $request->get("discription") : null,
            "status"                    =>  $request->has("status") ? $request->get("status") : null,
        ));
        if($menu->line_api_order_item){
            $menu->save();
            return redirect("/api/line/$channel_name/order/menu/$group/item");
        } else {
            return back()->withInput();
        }

    }
    public function item_show ($channel_name, $group, $id)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "group"     =>  LineApiOrderMenu::whereChannelName($channel_name)->whereGroup($group)->exists() ? $group : null,
            "menu"      =>  LineApiOrderMenu::whereChannelName($channel_name)->whereGroup($group)->whereId($id)->first(),
        );
        return view("admin.api.line.order.menu.item.show", $data);
    }
    public function item_edit ($channel_name, $group, $id)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "group"     =>  LineApiOrderMenu::whereChannelName($channel_name)->whereGroup($group)->exists() ? $group : null,
            "items"     =>  LineApiOrderItem::whereIn("channel_name",array($channel_name,"all"))->orderBy("category")->get(),
            "menu"      =>  LineApiOrderMenu::whereChannelName($channel_name)->whereGroup($group)->whereId($id)->first(),
        );
        return view("admin.api.line.order.menu.item.create", $data);
    }
    public function item_update (Request $request, $channel_name, $group, $id)
    {
        $menu   =   LineApiOrderMenu::whereChannelName($channel_name)->whereGroup($group)->whereId($id)->first();
        if($menu){
            $form   =   $request->only(array(
                "line_api_order_item_id",
                "display_name",
                "category",
                "sub_category",
                "price",
                "discription",
                "status",
            ));
            $menu->fill($form)->save();
            return redirect("/api/line/$channel_name/order/menu/$group/item");
        } else {
            return back()->withInput();
        }
    }
    public function item_delete ($channel_name, $group, $id)
    {
        $menu   =   LineApiOrderMenu::whereGroup($group)->whereChannelName($channel_name)->whereId($id)->first();
        $menu ? $menu->delete() : null;
        return redirect("/api/line/$channel_name/order/menu/$group/item");
    }
}

<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\LineApiChannel;
use App\Models\Api\LineApiOrderItem;
use Illuminate\Http\Request;

class LineApiOrderItemController extends Controller
{
    public function index($channel_name)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "items"     =>  LineApiOrderItem::whereIn("channel_name",array($channel_name, "all"))->get(),
        );
        return view("admin.api.line.order.item.index", $data);
    }

    public function create($channel_name)
    {
        $data   =   array(
            "channel"           =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "categories"        =>  LineApiOrderItem::whereChannelName($channel_name)->distinct()->pluck("category"),
            "sub_categories"    =>  LineApiOrderItem::whereChannelName($channel_name)->distinct()->pluck("sub_category"),
        );
        return view("admin.api.line.order.item.create", $data);
    }

    public function async_create($channel_name)
    {
        $data   =   array(
            "channel"           =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "categories"        =>  LineApiOrderItem::whereChannelName($channel_name)->distinct()->pluck("category"),
            "sub_categories"    =>  LineApiOrderItem::whereChannelName($channel_name)->distinct()->pluck("sub_category"),
        );
        return view("admin.api.line.order.item.create-async", $data);
    }

    public function store(Request $request, $channel_name)
    {
        $item   =   new LineApiOrderItem(array(
            "channel_name"  =>  $channel_name,
            "code"          =>  $request->has("code") ? $request->get("code") : null,
            "name"          =>  $request->has("name") ? $request->get("name") : null,
            "category"      =>  $request->has("category") ? $request->get("category") : null,
            "sub_category"  =>  $request->has("sub_category") ? $request->get("sub_category") : null,
            "size"          =>  $request->has("size") ? $request->get("size") : null,
            "material"      =>  $request->has("material") ? collect($request->get("material"))->map(fn($item) => !is_null($item["material"]) ? array("material" =>$item["material"], "quantity" => $item["quantity"]) :null )->filter() : null,
            "allergy"       =>  $request->has("allergy") ? $request->get("allergy") : null,
        ));

        if($request->has("square_image_url")){
            $request->get("square_image_url");
        }
        if($request->has("wide_image_url")){
            $request->get("wide_image_url");
        }
        $saved  =   $item->save();
        if($saved){
            return redirect("/api/line/$channel_name/order/item",302);
        } else {
            return back(400)->withInput();
        }
    }


    public function show($channel_name, $id)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "item"      =>  LineApiOrderItem::whereIn("channel_name",array($channel_name, "all"))->whereId($id)->first(),
        );
        return view("admin.api.line.order.item.show", $data);
    }

    public function edit($channel_name, $id)
    {
        $data   =   array(
            "channel"           =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "categories"        =>  LineApiOrderItem::whereChannelName($channel_name)->distinct()->pluck("category"),
            "sub_categories"    =>  LineApiOrderItem::whereChannelName($channel_name)->distinct()->pluck("sub_category"),
            "item"              =>  LineApiOrderItem::whereChannelName($channel_name)->whereId($id)->first(),
        );
        return view("admin.api.line.order.item.create", $data);
    }

    public function update(Request $request, $channel_name, $id)
    {
        $item   =   LineApiOrderItem::whereChannelName($channel_name)->whereId($id)->first();
        if($item){
            $item->code         =   $request->has("code") ? $request->get("code") : null;
            $item->name         =   $request->has("name") ? $request->get("name") : null;
            $item->category     =   $request->has("category") ? $request->get("category") : null;
            $item->sub_category =   $request->has("sub_category") ? $request->get("sub_category") : null;
            $item->size         =   $request->has("size") ? $request->get("size") : null;
            $item->material     =   $request->has("material") ? collect($request->get("material"))->map(fn($item) => !is_null($item["material"]) ? array("material" =>$item["material"], "quantity" => $item["quantity"]) :null )->filter() : null;
            $item->allergy      =   $request->has("allergy") ? $request->get("allergy") : null;
            if($request->has("square_image_url")){
                $request->get("square_image_url");
            }
            if($request->has("wide_image_url")){
                $request->get("wide_image_url");
            }
            $item->save();
        }
        return redirect("/api/line/$channel_name/order/item/$id");
    }

    public function delete($channel_name, $id)
    {
        $item   =   LineApiOrderItem::whereChannelName($channel_name)->whereId($id)->first();
        if($item && $channel_name!="all"){
            $item->delete();
        }
        return redirect("/api/line/$channel_name/order/item");
    }

    public function async_list($channel_name)
    {
        $items  =   LineApiOrderItem::whereIn("channel_name",array($channel_name, "all"))->orderBy("category")->get();
        return response()->json($items,200);
    }

    public function async_detail($channel_name, $id)
    {
        $items  =   LineApiOrderItem::whereIn("channel_name",array($channel_name, "all"))->where("id",$id)->first();
        return response()->json($items,200);
    }

}

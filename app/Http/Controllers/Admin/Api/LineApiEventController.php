<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\LineApiChannel;
use App\Models\Api\LineApiEvent;
use App\Models\Api\LineApiReply;
use App\Models\Api\LineApiUserGroup;
use Illuminate\Http\Request;

class LineApiEventController extends Controller
{
    public function index($channel_name)
    {
        $data   =   array(
            "channel"           =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "grouped_events"    =>  LineApiEvent::whereChannelName($channel_name)->get()->groupBy("event_name"),
        );
        return view("admin.api.line.event.index", $data);
    }

    public function create($channel_name, $event_name = null)
    {
        $data   =   array(
            "channel"       =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "event_name"    =>  $event_name,
            "user_groups"   =>  LineApiUserGroup::whereChannelName($channel_name)->get(),
        );
        return view("admin.api.line.event.create", $data);
    }

    public function store(Request $request, $channel_name, $event_name = null)
    {
        $line_api_event =   LineApiEvent::whereChannelName($channel_name)->whereEventName($event_name)->first();
        if(!$line_api_event){
            $line_api_event =   new LineApiEvent();
        }
        $form   =   array(
            "channel_name"      =>  $channel_name,
            "category"          =>  $request->get("category"),
            "sub_category"      =>  $request->get("sub_category"),
            "event_name"        =>  $event_name ? $event_name : $request->get("event_name"),
            "name"              =>  $request->get("name"),
            "discription"       =>  $request->get("discription"),
            "cover_image_url"   =>  $request->get("cover_image_url"),
            "no_image_url"      =>  $request->get("no_image_url"),
            "status"            =>  $request->get("status"),
            "organizer"         =>  $request->get("organizer"),
            "place"             =>  $request->get("place"),
            "address"           =>  $request->get("address"),
            "price"             =>  $request->get("price"),
            "open_at"           =>  $request->get("open_at"),
            "start_at"          =>  $request->get("start_at"),
            "end_at"            =>  $request->get("end_at"),
            "close_at"          =>  $request->get("close_at"),
            "count"             =>  $request->get("count") ? true : false,
            "user_groups"       =>  $request->get("user_groups"),
        );
        $line_api_event->fill($form)->save();
        return redirect("/api/line/$channel_name/event/$line_api_event->event_name/$line_api_event->id");

    }

    public function event($channel_name, $event_name)
    {
        $data   =   array(
            "channel"       =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "event_name"    =>  $event_name,
            "events"        =>  LineApiEvent::whereChannelName($channel_name)->whereEventName($event_name)->get(),
        );
        return view("admin.api.line.event.event", $data);
    }

    public function show($channel_name, $event_name, $id)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "event_name"     =>  $event_name,
            "event"     =>  LineApiEvent::whereChannelName($channel_name)->whereEventName($event_name)->whereId($id)->first(),
        );
        return view("admin.api.line.event.show", $data);
    }

    public function edit($channel_name, $event_name, $id)
    {
        $data   =   array(
            "channel"       =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "event_name"    =>  $event_name,
            "event"         =>  LineApiEvent::whereChannelName($channel_name)->whereEventName($event_name)->whereId($id)->first(),
            "user_groups"   =>  LineApiUserGroup::whereChannelName($channel_name)->get(),
        );
        return view("admin.api.line.event.create", $data);
    }

    public function delete($channel_name, $event_name, $id)
    {
        $event  =   LineApiEvent::whereChannelName($channel_name)->whereEventName($event_name)->whereId($id)->first();
        if($event){
            $event->delete();
            return redirect("/api/line/$channel_name/event/$event_name");
        } else {
            return back();
        }
    }


    /** postback */
    public function postback_index($channel_name)
    {
        $data   =   array(
            "channel"           =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "replies"           =>  LineApiReply::whereChannelName($channel_name)->whereType("postback")->where("condition","like","%action=event%")->orderByDesc("updated_at")->get(),
            "grouped_events"    =>  LineApiEvent::whereChannelName($channel_name)->get()->groupBy("event_name"),
        );
        return view("admin.api.line.reply.postback.event.index", $data);
    }
}

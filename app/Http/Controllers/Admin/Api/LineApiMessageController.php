<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\LineApiChannel;
use App\Models\Api\LineApiMessage;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class LineApiMessageController extends Controller
{
    /** /api/line/{$channel_name}/message */
    public function index($channel_name)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "messages"  =>  LineApiMessage::whereChannelName($channel_name)->whereDisplay("表示")->get(),
        );
        return view('admin.api.line.message.index', $data);
    }

    public function create($channel_name, $type)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "messages"  =>  LineApiMessage::whereChannelName($channel_name)->get(),
        );
        return view("admin.api.line.message.create.$type", $data);
        
    }

    public function async_create($channel_name, $type)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "messages"  =>  LineApiMessage::whereChannelName($channel_name)->get(),
        );
        return view("admin.api.line.message.async.$type", $data);
        
    }

    public function store(Request $request, $channel_name)
    {
        $message    =   new LineApiMessage(array(
            "channel_name"  =>  $channel_name,
        ));
        $form   =   $request->only(array(
            "status",
            "display",
            "validate_status",
            "message",
            "type",
            "text",
            "emojis",
            "package_id",
            "sticker_id",
            "original_content_url",
            "preview_image_url",
            "tracking_id",
            "duration",
            "title",
            "address",
            "latitude",
            "longitude",
            "alt_text",
            "base_url",
            "base_size",
            "video",
            "actions",
            "template",
            "contents",
        ));
        $message->fill($form)->save();
        return redirect("/api/line/$channel_name/message",302);
    }

    public function delete($channel_name, $id)
    {
        $line_api_message   =   LineApiMessage::whereChannelName($channel_name)->whereId($id)->whereStatus("未送信")->first();
        if($line_api_message){
            $line_api_message->delete();
            return redirect("/api/line/$channel_name/message");
        } else {
            return back();
        }
    }



    public function async_list($channel_name, $type)
    {
        $messages   =   LineApiMessage::whereChannelName($channel_name)->get();
        return response()->json($messages,200);        
    }



    public function message_json($channel_name, $id)
    {
        $message    =   LineApiMessage::find($id);
        if($message->channel_name == $channel_name){
            $json   =   $message->get_message_object_for_send();
            return response()->json($json,200);
        } else {
            return back();
        }
    }



    public function form($channel_name, $type)
    {
        $data   =   LineApiMessage::get_message_form($type);
        if($data) {
            return response()->json($data,200);
        } else {
            return back();
        }
    }


}

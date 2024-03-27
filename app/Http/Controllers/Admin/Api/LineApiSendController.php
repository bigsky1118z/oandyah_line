<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\LineApiChannel;
use App\Models\Api\LineApiMessage;
use App\Models\Api\LineApiSend;
use App\Services\Api\LineApiService;
use Illuminate\Http\Request;

class LineApiSendController extends Controller
{
    protected $line_api_service;

    public function __construct(LineApiService $line_api_service)
    {
        $this->line_api_service    =   $line_api_service;
    }

    public function index($channel_name)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "error"     =>  LineApiSend::whereChannelName($channel_name)->whereStatus("エラー")->get(),
            "draft"     =>  LineApiSend::whereChannelName($channel_name)->whereStatus("下書き")->get(),
            "reserve"   =>  LineApiSend::whereChannelName($channel_name)->whereStatus("送信予約")->get(),
            "standby"   =>  LineApiSend::whereChannelName($channel_name)->whereStatus("standby")->get(),
            "sent"      =>  LineApiSend::whereChannelName($channel_name)->whereStatus("送信済み")->orderByDesc("sent_at")->get(),

            "quota"             =>  $this->line_api_service->get_quota($channel_name),
            "quota_consumption" =>  $this->line_api_service->get_quota_consumption($channel_name),
        );
        return view('admin.api.line.send.index', $data);
    }
    public function index2($channel_name)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "sent"      =>  LineApiSend::whereChannelName($channel_name)->whereStatus("送信済み")->orderByDesc("sent_at")->get(),

            "quota"             =>  $this->line_api_service->get_quota($channel_name),
            "quota_consumption" =>  $this->line_api_service->get_quota_consumption($channel_name),
        );
        return view('admin.api.line.send.index2', $data);
    }
    
    /** GET /api/line/{$channel_name}/send/create */
    public function create($channel_name)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
        );
        return view('admin.api.line.send.create', $data);
    }
    public function create2($channel_name)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "messages"  =>  LineApiMessage::whereChannelName($channel_name)->get(),
        );
        return view('admin.api.line.send.create2', $data);
    }

    public function store(Request $request, $channel_name)
    {
        return $request;
        if($request){
            $this->line_api_service->send($request, $channel_name);
            // $result = $this->line_api_service->send($request, $channel_name);
            // return $result;
            return redirect("/api/line/$channel_name/send");
        }else{
            return back()->withInput();
        }
    }

    public function delete($channel_name, $id)
    {
        $send   =   LineApiSend::find($id);
        if($send->channel_name == $channel_name && $send->response_status != 200){
            $send->delete();
        }
        return redirect("api/line/".$channel_name."/send");
    }
}

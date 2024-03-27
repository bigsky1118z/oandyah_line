<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\LineApiChannel;
use App\Models\Api\LineApiUserGroup;
use Illuminate\Http\Request;

class LineApiUserGroupController extends Controller
{
    public function show ($channel_name, $id)
    {
        $data   =   array(
            "channel"               =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "line_api_user_group"   =>  LineApiUserGroup::whereChannelName($channel_name)->whereId($id)->first(),
        );
        return view("admin.api.line.user.group.show", $data);

    }
}

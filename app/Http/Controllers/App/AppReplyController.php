<?php

namespace App\Http\Controllers\App;

use App\Models\App;
use App\Models\User;
use Illuminate\Http\Request;

class AppReplyController extends Controller
{
    public function index(Request $request, $user_name, $client_id)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($client_id)->app ?? new App();
        $data   =   array(
            "user"  =>  $user,
            "app"   =>  $app,
        );
        return view("app.reply.index", $data);
    }
}

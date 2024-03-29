<?php

namespace App\Http\Controllers\App;

use App\Models\App\App;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use function PHPSTORM_META\elementType;

class AppController extends Controller
{
    public function index(Request $request,$user_name)
    {
        $data   =   array(
            "user"  =>  auth()->user(),
        );
        return view("app.index", $data);
    }

    public function create(Request $request,$user_name, $app_name = null)
    {
        $data   =   array(
            "user"  =>  auth()->user(),
        );
        return view("app.create", $data);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            "app_name"              => ["required","unique:apps,app_name","min:4","max:16"],
            "channel_access_token"  => ["required","unique:apps,channel_access_token"],
        ]);
        $app_name               =   $request->get("app_name");
        $channel_access_token   =   $request->get("channel_access_token");
        $channel_access_token   =   "46jMDeKXz36hFGeefYyNJ906lND6bcTmn3E9BXy2dO5qvj1BqUmsCKF79g44eFk+0LyRD75pNGCVWw3PkVm948DZMFEifDfld+fhFvta4eWCIxfEpaMj8dF4EdWk0aw66BWCFsVkpRJu8nrAhQKgaAdB04t89/1O/w1cDnyilFU=";
        $response               =   App::get_bot_channel_webhook_endpoint($channel_access_token);
        if($response->successful()){
            return $response;
        } else {
            return back();
        }

    }


    public function show(Request $request,$user_name,$app_name)
    {
        $user   =   User::find(auth()->user()->id);
        $data   =   array(
            "user"  =>  $user,
            "app"   =>  $user->apps($app_name),
        );
        return view("app.show", $data);
    }

}

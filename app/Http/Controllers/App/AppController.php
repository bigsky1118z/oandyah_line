<?php

namespace App\Http\Controllers\App;

use App\Library\MessagingApi;
use App\Models\App;
use App\Models\User;
use App\Models\UserApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

use function PHPSTORM_META\elementType;

class AppController extends Controller
{
    public function index(Request $request, $user_name)
    {
        $user   =   User::find(auth()->user()->id);
        $data   =   array(
            "user"  =>  $user,
        );
        return view("app.index", $data);
    }

    public function create(Request $request,$user_name, $client_id = null)
    {
        $user   =   User::find(auth()->user()->id);
        $data   =   array(
            "user"  =>  $user,
        );
        return view("app.create", $data);
    }


    public function store(Request $request, $user_name)
    {
        $request->validate([
            "channel_access_token"  => ["required","string"],
            "channel_secret"        => ["required","string"],
        ]);
        $channel_access_token   =   $request->get("channel_access_token");
        $channel_secret         =   $request->get("channel_secret");
        $app                    =   App::create_app($channel_access_token, $channel_secret);
        $user                   =   User::find(auth()->user()->id);
        if($app && $user){
            $user->regist_app($app);
            return redirect(asset("$user->name/app/$app->client_id"));
        } else {
            return back();
        }
    }

    public function show(Request $request, $user_name, $client_id)
    {
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($client_id)->app->latest();
        $role   =   $user->app($client_id)->role;
        $data   =   array(
            "user"  =>  $user,
            "app"   =>  $app,
            "role"  =>  $role,
        );
        return view("app.show", $data);
    }



}

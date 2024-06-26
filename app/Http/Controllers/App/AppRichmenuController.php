<?php

namespace App\Http\Controllers\App;

use App\Library\MessagingApi;
use App\Models\App\AppRichmenu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppRichmenuController extends Controller
{
    public function index(Request $request, $user_name, $client_id)
    {
        $user       =   User::find(auth()->user()->id);
        $app        =   $user->app($client_id)->app;
        $richmenus  =   $app->richmenus;
        $data   =   array(
            "user"      =>  $user,
            "app"       =>  $app,
            "richmenus" =>  $richmenus,
        );
        return view("app.richmenu.index", $data);
    }

    public function create(Request $request, $user_name, $client_id, $app_richmenu_id = null)
    {
        $user       =   User::find(auth()->user()->id);
        $app        =   $user->app($client_id)->app;
        $richmenu   =   $app->richmenu($app_richmenu_id) ?? new AppRichmenu();
        $richmenu   =   $richmenu->latest();
        $types      =   AppRichmenu::$types;
        $data       =   array(
            "user"      =>  $user,
            "app"       =>  $app,
            "richmenu"  =>  $richmenu,
            "types"     =>  $types,
        );
        if($richmenu->status=="active"){
            return view("app.richmenu.show", $data);
        }
        return view("app.richmenu.create", $data);
    }

    public function store(Request $request, $user_name, $client_id, $app_richmenu_id = null)
    {
        $user           =   User::find(auth()->user()->id);
        $app            =   $user->app($client_id)->app;
        $app_richmenu   =   $app->richmenu($app_richmenu_id) ?? new AppRichmenu();
        if($app_richmenu->status == "active" || $app_richmenu->status == "not_found"){
        } else {
            $app_richmenu   =   AppRichmenu::updateOrCreate(array(
                "id"            =>  $app_richmenu_id,
            ),array(
                "app_id"        =>  $app->id,
                "name"          =>  $request->input("name")             ??  null,
                "chat_bar_text" =>  $request->input("chat_bar_text")    ??  null,
                "selected"      =>  $request->input("selected")         ?   true : false,
                "size"          =>  $request->input("size")             ??  array(),
                "areas"         =>  AppRichmenu::convert_areas($request->input("areas") ?? array()),
            ));
            $richmenu_content   =   $request->file("richmenu_content");
            if($richmenu_content){
                $size                   =   $richmenu_content->getSize();
                $extension              =   $richmenu_content->getClientOriginalExtension();
                list($width, $height)   =   getimagesize($richmenu_content->getRealPath());
                if($size < 1024 * 1024 && 800 <= $width && $width <= 2500 && 250 <= $height && $width/$height >= 1.45){
                    $directory  =   "public/app/$client_id/richmenu_content";
                    $filename   =   "$app_richmenu->id.$extension";
                    Storage::makeDirectory($directory);
                    if($app_richmenu->get_richmenu_content_exists()){
                        $app_richmenu->get_richmenu_content_delete();
                    }        
                    $richmenu_content->storeAs($directory, $filename);
                }
            }
            $app_richmenu->latest();
        }
        return redirect(asset("$user_name/app/$client_id/richmenu"));
    }

    public function upload(Request $request, $user_name, $client_id, $app_richmenu_id)
    {
        $user           =   User::find(auth()->user()->id);
        $app            =   $user->app($client_id)->app;
        $app_richmenu   =   $app->richmenu($app_richmenu_id);
        $app_richmenu   =   $app_richmenu->latest();
        if($app_richmenu->status == "standby"){
            $app_richmenu->post_richmenu();
        }
        return redirect(asset("$user_name/app/$client_id/richmenu"));
    }
    public function update(Request $request, $user_name, $client_id){
        $user   =   User::find(auth()->user()->id);
        $app    =   $user->app($client_id)->app;
        AppRichmenu::update_richmenus($app);
        return redirect(asset("$user_name/app/$client_id/richmenu"));
    }
    public function destroy(Request $request, $user_name, $client_id, $app_richmenu_id)
    {
        $user           =   User::find(auth()->user()->id);
        $app            =   $user->app($client_id)->app;
        $app_richmenu   =   $app->richmenu($app_richmenu_id) ?? new AppRichmenu();
        if($app_richmenu->status == "active"){
            $app_richmenu->delete_richmenu();
            $app_richmenu->latest();
        } else {
            $app_richmenu->delete();
        }
        return redirect(asset("$user_name/app/$client_id/richmenu"));
    }


    public function post_default(Request $request, $user_name, $client_id, $app_richmenu_id){
        $user       =   User::find(auth()->user()->id);
        $app        =   $user->app($client_id)->app;
        $richmenu   =   $app->richmenu($app_richmenu_id);
        $richmenu->post_richmenu_default();
        return redirect(asset("$user_name/app/$client_id/richmenu"));
    }
    public function delete_default(Request $request, $user_name, $client_id){
        $user       =   User::find(auth()->user()->id);
        $app        =   $user->app($client_id)->app;
        MessagingApi::delete_richmemu_default($app->channel_access_token);
        return redirect(asset("$user_name/app/$client_id/richmenu"));
    }

}

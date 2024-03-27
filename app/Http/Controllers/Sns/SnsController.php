<?php

namespace App\Http\Controllers\Sns;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Sns\Sns;
use App\Models\Sns\SnsConfig;
use App\Models\Sns\SnsLink;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;


class SnsController extends Controller
{
    public function index()
    {
        $user   =   auth()->user();
        $data   =   array(
            "user"  =>  $user,
        );
        $user   ?   $data["snss"] = Sns::whereUserId($user->id)->get() : null;
        return view("sns.index", $data);
    }

    public function create($name = null)
    {
        $user   =   auth()->user();
        if($user){
            $data   =   array(
                "user"  =>  $user,
                "types" =>  SnsConfig::$types,
            );
            $sns    =   Sns::whereUserId($user->id)->whereName($name)->first();
            $sns    ?   $data["sns"] = $sns : null;
            return view("sns.create", $data);
        } else {
            return redirect("/sns");
        }
    }

    public function store(Request $request, $name = null)
    {
        $user           =   auth()->user();
        $new_name       =   $request->get("name");
        $title          =   $request->get("title");
        $description    =   $request->get("description");
        $icon           =   $request->file("icon");
        $configs        =   array(
            "type"  =>  $request->get("type"),

        );
        if(!$user){
            return redirect("/sns");
        } 
        if(($name != $new_name && Sns::whereName($new_name)->exists()) || in_array($new_name, array("create", "login", "regist", "default"))) {
            $request->merge(array("name" => $name));
            return back()->withInput($request->only("name", "title", "description", "type"));
        }
        $sns    =   Sns::updateOrCreate(array(
            "user_id"       =>  $user->id,
            "name"          =>  $name,
        ), array(
            "name"          =>  $new_name,
            "title"         =>  $title,
            "description"   =>  $description,
        ));
        foreach($configs as $config_name => $config_value){
            $sns->set_config($config_name, $config_value);
        }
        if($icon){
            $extension  =   $icon->guessExtension();
            if(in_array($extension,array("jpg", "png"))){
                $path   =   "public/sns/icon";
                // $path   =   "public/sns/logo";
                Storage::disk("local")->exists($path) ? null : Storage::disk("local")->makeDirectory($path, 0755, true);
                $file_name  =   "$name" . "." . $extension;
                // $file_name  =   "website" . "." . $extension;
                $icon->storeAs($path,$file_name);
                $extension == "png" && Storage::disk("local")->exists($path . "/" . $name . ".jpg") ? Storage::disk("local")->delete($path . "/" . $name . ".jpg") : null;
                $extension == "jpg" && Storage::disk("local")->exists($path . "/" . $name . ".png") ? Storage::disk("local")->delete($path . "/" . $name . ".png") : null;

            }
        }
        return redirect("/sns/$new_name");
    }

    public function show($name)
    {
        if(Sns::whereName($name)->exists()){
            $sns    =   Sns::whereName($name)->first();
            $data   =   array(
                "sns"       =>  $sns,
                "sns_types" =>  SnsLink::$types,
            );
            $user   =   auth()->user();
            if($user && $user->id == $sns->user_id){
                $data["user"]   =   $user;
            }
            return view("sns.show", $data);
        } else {
            return redirect("/sns");
        }
    }

    public function delete($name)
    {
        $user   =   auth()->user();
        $user   ?   Sns::whereUserId($user->id)->whereName($name)->delete() : null;
        return redirect("/sns");
    }

    public function user_create()    // : RedirectResponse
    {
        $user   =   auth()->user();
        if($user){
            return redirect("/sns");
        } else {
            return view("sns.register");
        }
    }

    public function user_store(Request $request){
        $request->validate([
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $request->has("nickname") ? $user->set_name("nickname",$request->get("nickname")) : null ;
        // event(new Registered($user));
        Auth::login($user);
        return redirect("/sns");

    }

    public function login(LoginRequest $request)    // : RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect("/sns");
    }

    public function logout(Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/sns");
    }


}

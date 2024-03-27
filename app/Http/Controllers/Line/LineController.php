<?php

namespace App\Http\Controllers\Line;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Line\Line;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LineController extends Controller
{
    public function index()
    {
        return "line";
        $user   =   auth()->user();
        $data   =   array(
            "user"  =>  $user,
        );
        $user   ?   $data["lines"] = Line::whereUserId($user->id)->get() : null;
        return view("line.index", $data);
    }

    public function show($line_name)
    {
        $user   =   auth()->user();
        if(!$user){
            return redirect("/line");
        }
        $line   =   Line::whereUserId($user->id)->whereName($line_name)->first();
        if(!$line){
            return redirect("/line");
        }
        $data   =   array(
            "user"  =>  $user,
            "line"  =>  $line,
        );
        return view("line.show", $data);
    }

    public function login(LoginRequest $request)    // : RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect("/line");
    }

    public function logout(Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/line");
    }




    // public function create($line_name = null)
    // {
    //     $user   =   auth()->user();
    //     if($user){
    //         $data   =   array(
    //             "user"  =>  $user,
    //             "types" =>  SnsConfig::$types,
    //         );
    //         $sns    =   Sns::whereUserId($user->id)->whereName($line_name)->first();
    //         $sns    ?   $data["sns"] = $sns : null;
    //         return view("sns.create", $data);
    //     } else {
    //         return redirect("/sns");
    //     }
    // }

    // public function store(Request $request, $line_name = null)
    // {
    //     $user           =   auth()->user();
    //     $new_name       =   $request->get("name");
    //     $title          =   $request->get("title");
    //     $description    =   $request->get("description");
    //     $icon           =   $request->file("icon");
    //     $configs        =   array(
    //         "type"  =>  $request->get("type"),

    //     );
    //     if(!$user){
    //         return redirect("/sns");
    //     } 
    //     if(($line_name != $new_name && Sns::whereName($new_name)->exists()) || in_array($new_name, array("create", "login", "regist", "default"))) {
    //         $request->merge(array("name" => $line_name));
    //         return back()->withInput($request->only("name", "title", "description", "type"));
    //     }
    //     $sns    =   Sns::updateOrCreate(array(
    //         "user_id"       =>  $user->id,
    //         "name"          =>  $line_name,
    //     ), array(
    //         "name"          =>  $new_name,
    //         "title"         =>  $title,
    //         "description"   =>  $description,
    //     ));
    //     foreach($configs as $config_name => $config_value){
    //         $sns->set_config($config_name, $config_value);
    //     }
    //     if($icon){
    //         $extension  =   $icon->guessExtension();
    //         if(in_array($extension,array("jpg", "png"))){
    //             $path   =   "public/sns/icon";
    //             // $path   =   "public/sns/logo";
    //             Storage::disk("local")->exists($path) ? null : Storage::disk("local")->makeDirectory($path, 0755, true);
    //             $file_name  =   "$line_name" . "." . $extension;
    //             // $file_name  =   "website" . "." . $extension;
    //             $icon->storeAs($path,$file_name);
    //             $extension == "png" && Storage::disk("local")->exists($path . "/" . $line_name . ".jpg") ? Storage::disk("local")->delete($path . "/" . $line_name . ".jpg") : null;
    //             $extension == "jpg" && Storage::disk("local")->exists($path . "/" . $line_name . ".png") ? Storage::disk("local")->delete($path . "/" . $line_name . ".png") : null;

    //         }
    //     }
    //     return redirect("/sns/$new_name");
    // }

    // public function show($line_name)
    // {
    //     if(Sns::whereName($line_name)->exists()){
    //         $sns    =   Sns::whereName($line_name)->first();
    //         $data   =   array(
    //             "sns"       =>  $sns,
    //             "sns_types" =>  SnsLink::$types,
    //         );
    //         $user   =   auth()->user();
    //         if($user && $user->id == $sns->user_id){
    //             $data["user"]   =   $user;
    //         }
    //         return view("sns.show", $data);
    //     } else {
    //         return redirect("/sns");
    //     }
    // }

    // public function delete($line_name)
    // {
    //     $user   =   auth()->user();
    //     $user   ?   Sns::whereUserId($user->id)->whereName($line_name)->delete() : null;
    //     return redirect("/sns");
    // }

    // public function user_create()    // : RedirectResponse
    // {
    //     $user   =   auth()->user();
    //     if($user){
    //         return redirect("/sns");
    //     } else {
    //         return view("sns.register");
    //     }
    // }

    // public function user_store(Request $request){
    //     $request->validate([
    //         'email'     => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
    //         'password'  => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);
    //     $user = User::create([
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);
    //     $request->has("nickname") ? $user->set_name("nickname",$request->get("nickname")) : null ;
    //     // event(new Registered($user));
    //     Auth::login($user);
    //     return redirect("/sns");

    // }

    // public function login(LoginRequest $request)    // : RedirectResponse
    // {
    //     $request->authenticate();
    //     $request->session()->regenerate();
    //     return redirect("/sns");
    // }

    // public function logout(Request $request) {
    //     Auth::guard('web')->logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return redirect("/sns");
    // }


}

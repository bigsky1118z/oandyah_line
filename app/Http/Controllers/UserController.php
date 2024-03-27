<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User\Role;
use App\Models\User\Subdirectory;
use App\Models\User\UserCategory;
use App\Models\User\UserRole;
use App\Models\User\UserCompany;
use App\Models\User\UserDetail;
use App\Models\User\UserSubdirectoryRole;
use App\Models\Webapp\Company;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = array(
            'users'             =>  User::all(),
            "subdirectories"    =>  Subdirectory::all(),
        );
        return view('website.edit.user.index', $data);
    }

    /**
     * Display the specified resource.
     */

    public function show($user_id)
    {
        $user   =   User::find($user_id);
        if($user){
            $data   =   array(
                "user"              =>  $user,
                "subdirectories"    =>  Subdirectory::all(),
            );
            return view("website.edit.user.show", $data);
        } else {
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */    
    public function create($user_id = null)
    {
        $data   =   array(
            "subdirectories"    =>  Subdirectory::all(),
        );
        $user   =   User::find($user_id);
        $user ? $data["user"] = $user : null;
        return view("website.edit.user.create", $data);
    }

    public function store(Request $request, $user_id = null)
    {
        $request->merge(array('id' => $user_id));
        $form   =   $request->all();
        unset($form["_token"]);
        $user   =   User::find($user_id);
        if($user){
            if($request->has("email")){
                $email  =   $request->get("email");
                if($user->email != $email && User::whereEmail($email)->exists()) {
                    return back()->withInput();
                } else {
                    $user->email    =   $email;
                    $user->save();
                }
            }
        } else {
            if($request->has("email") && $request->has("password") && User::whereEmail($request->get("email"))->doesntExist()){
                $user   =   User::Create(array(
                    "email"             =>  $request->get("email"),
                    "email_verified_at" =>  date("Y-m-d H:i:s"),
                    "password"          =>  Hash::make($request->get("password")),
                ));
                $request->merge(array('id' => $user->id));
            } else {
                $request->except("password");
                return back()->withInput();
            }
        }

        // $user->name
        $names  =   array("jp","kana","en");
        foreach($names as $name){
            $last_name      =   $request->has("name_last_name_" . $name)    ?   $request->get("name_last_name_" . $name)    :   null;
            $first_name     =   $request->has("name_first_name_" . $name)   ?   $request->get("name_first_name_" . $name)   :   null;
            $middle_name    =   $request->has("name_middle_name_" . $name)  ?   $request->get("name_middle_name_" . $name)  :   null;
            $maiden_name    =   $request->has("name_maiden_name_" . $name)  ?   $request->get("name_maiden_name_" . $name)  :   null;
            $user->set_name($name, $last_name, $first_name, $middle_name, $maiden_name);
        }
        $sub_names  =   array("nickname","naming","honorific_title");
        foreach($sub_names as $sub_name){
            $request->has("name_" . $sub_name) ? $user->set_name($sub_name, $request->get("name_" . $sub_name)) : null;
        }

        // $user->birthday
        $birth_year     =   $request->has("birth_year")     ? $request->get("birth_year")       : null;
        $birth_month    =   $request->has("birth_month")    ? $request->get("birth_month")      : null;
        $birth_day      =   $request->has("birth_day")      ? $request->get("birth_day")        : null;
        $birth_hours    =   $request->has("birth_hours")    ? $request->get("birth_hours")      : null;
        $birth_minutes  =   $request->has("birth_minutes")  ? $request->get("birth_minutes")    : null;
        $birth_place    =   $request->has("birth_place")    ? $request->get("birth_place")      : null;
        $user->set_birthday($birth_year, $birth_month, $birth_day, $birth_hours, $birth_minutes, $birth_place);

        // $user->subdirectory_role
        $subdirectories =   Subdirectory::all();
        foreach($subdirectories as $subdirectory){
            if($subdirectory->roles()->exists()){
                foreach($subdirectory->roles as $role){
                    if(isset($role->role->value) && isset($request->get("subdirectory_roles")[$subdirectory->value])){
                        if(in_array($role->role->value, $request->get("subdirectory_roles")[$subdirectory->value])){
                            $user->set_subdirectory_role($subdirectory->value, $role->role->value);
                        } else {
                            $user->delete_subdirectory_role($subdirectory->value, $role->role->value);
                        }
                    } elseif(isset($role->role->value) && !isset($request->get("subdirectory_roles")[$subdirectory->value])) {
                        $user->delete_subdirectory_role($subdirectory->value);
                    }
                }
            }
        }
        return redirect("/edit/user/$user->id");
    }

    public function delete($user_id)
    {
        $admin  =   User::find(auth()->user()->id);
        $user   =   User::find($user_id);
        if($admin->is_admin() && $user && $user->id != 1 && !$user->is_admin()) {
            $user->delete();
            return redirect("/edit/user");
        } else {
            return back()->withInput();
        }
    }

}

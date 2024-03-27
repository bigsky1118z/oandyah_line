<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Website\WebsiteMembership;
use Illuminate\Http\Request;

class WebsiteMembershipController extends Controller
{
    public function index()
    {
        $data   =   array(
            "memberships"   =>  WebsiteMembership::whereNot("name", "ユーザー登録")->get(),
        );
        return view("website.edit.membership.index", $data);
    }

    public function create($membership_id = null)
    {
        $data       =   array(
            "users" =>  User::all(),
        );
        $membership =   WebsiteMembership::whereId($membership_id)->whereNot("name","ユーザー登録")->first();
        if($membership){
            $data["membership"] =   $membership;
        }
        return view("website.edit.membership.create", $data);        
    }

    public function store(Request $request, $membership_id = null)
    {
        $name   =   $request->get("name");
        $all    =   WebsiteMembership::whereName("ユーザー登録")->first();
        if($name == "ユーザー登録" || $membership_id == $all->id) {
            $request->merge(array("id" => $membership_id));
            return back()->withInput();
        }
        $membership =   WebsiteMembership::updateOrCreate(
            array(
                "id"            =>  $membership_id,
            ),
            array(
                "name"          =>  $name,
                "grade"         =>  $request->get("grade"),
                "discription"   =>  $request->get("discription"),
            )
        );
        if($request->has("users")){
            $old_users  =   $membership->user_ids();
            $new_users  =   array_map(fn($value)=>(int) $value ,$request->get("users"));
            foreach($old_users as $user_id){
                $new_users && in_array($user_id, $new_users) ? null : $membership->remove_user($user_id);
            }
            foreach($new_users as $user_id){
                $old_users && in_array($user_id, $old_users) ? null : $membership->add_user($user_id);
            }
        } else {
            $membership->users()->delete();
        }
        return redirect("/edit/membership");
    }

    public function delete($membership_id)
    {
        $all        =   WebsiteMembership::whereName("ユーザー登録")->first();
        $membership =   WebsiteMembership::find($membership_id);
        if($membership && $all != $membership){
            $membership->delete();
        }
        return redirect("/edit/membership");
    }
}

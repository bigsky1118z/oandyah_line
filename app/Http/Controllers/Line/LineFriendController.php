<?php

namespace App\Http\Controllers\Line;

use App\Http\Controllers\Controller;
use App\Models\Line\Line;
use Illuminate\Http\Request;

class LineFriendController extends Controller
{
    public function index($name)
    {
        $user   =   auth()->user();
        if(!$user){
            return redirect("/line");
        }
        $line   =   Line::whereUserId($user->id)->whereName($name)->first();
        if(!$line){
            return redirect("/line");
        }
        $data   =   array(
            "user"  =>  $user,
            "line"  =>  $line,
        );
        return view("line.friend.index", $data);
    }

    public function update($name)
    {
        $user   =   auth()->user();
        if(!$user){
            return redirect("/line");
        }
        $line   =   Line::whereUserId($user->id)->whereName($name)->first();
        if(!$line){
            return redirect("/line");
        }
        foreach($line->friends as $friend){
            $friend->get_bot_profile();
        }
        return redirect("/line/$name/friend");
    }

}

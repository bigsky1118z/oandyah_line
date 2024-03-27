<?php

namespace App\Http\Controllers\Line;

use App\Http\Controllers\Controller;
use App\Models\Line\Line;
use Illuminate\Http\Request;

class LineGroupController extends Controller
{
    public function index($line_name)
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
        return view("line.group.index", $data);
    }

    public function show($line_name, $group_name)
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
            "group" =>  $line->groups()->whereName($group_name)->first(),
        );
        return view("line.group.show", $data);
    }

}

<?php

namespace App\Http\Controllers\Sns;

use App\Http\Controllers\Controller;
use App\Models\Sns\Sns;
use App\Models\Sns\SnsLink;
use Illuminate\Http\Request;

class SnsLinkController extends Controller
{
    public function create($name)
    {
        $user   =   auth()->user();
        if(!$user){
            return redirect("/sns");
        }
        $sns    =   Sns::whereUserId($user->id)->whereName($name)->first();
        if($sns){
            $data   =   array(
                "sns"   =>  $sns,
                "types" =>  SnsLink::$types,
            );
            return view("sns.link", $data);
        } else {
            return redirect("/sns");
        }
    }

    public function store(Request $request, $name)
    {
        $user   =   auth()->user();
        if(!$user){
            return redirect("/sns");
        }
        $sns    =   Sns::whereUserId($user->id)->whereName($name)->first();
        if($sns){

            SnsLink::whereSnsId($sns->id)->update(array("order" => null, "active" => false));
            $links  =   $request->get("link");
            usort($links, fn($a, $b)=> - $a['order'] + $b['order']);

            foreach($links as $link){
                if(isset($link["type"], $link["value"])){
                    SnsLink::updateOrCreate(array(
                        "sns_id"    =>  $sns->id,
                        "type"      =>  $link["type"],
                        "value"     =>  $link["value"],
                    ),array(
                        "active"                =>  isset($link["active"])              ? true                          : false,
                        "title"                 =>  isset($link["title"])               ? $link["title"]                : null,
                        "description"           =>  isset($link["description"])         ? $link["description"]          : null,
                        "image_url_thumbnail"   =>  isset($link["image_url_thumbnail"]) ? $link["image_url_thumbnail"]  : null,
                        "image_url_header"      =>  isset($link["image_url_header"])    ? $link["image_url_header"]     : null,
                        "order"                 =>  isset($link["order"])               ? $link["order"]                : null,
                    ));
                }
            }
            SnsLink::whereSnsId($sns->id)->whereOrder(null)->delete();
            return redirect("/sns/$name");
        } else {
            return redirect("/sns");
        }
    }
}

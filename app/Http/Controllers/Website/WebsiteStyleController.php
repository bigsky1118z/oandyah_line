<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Website\WebsiteStyle;
use Illuminate\Http\Request;

class WebsiteStyleController extends Controller
{
    public function index()
    {
        return view("website.edit.style.index");
    }


    public function default()
    {
        $data   =   array(
            "styles"    =>  WebsiteStyle::whereCategory("default")->orderBy("selector")->get()->groupBy("selector"),
        );
        return view("website.edit.style.default", $data);
    }

    public function customize()
    {
        $data   =   array(
            "styles"    =>  WebsiteStyle::whereCategory("customize")->orderBy("selector")->get(),
        );
        return view("website.edit.style.customize", $data);
    }

    public function create($id = null)
    {
        $data   =   array();
        if($id){
            $data["style"]  =   WebsiteStyle::find($id);
        }
        return view("website.edit.style.create", $data);
    }

    public function store(Request $request)
    {
        $styles =   $request->get("style");
        foreach($styles as $style){
            if($style["selector"] && $style["property"] && $style["value"]){
                WebsiteStyle::Create(array(
                    "category"  =>  "customize",
                    "selector"  =>  $style["selector"],
                    "property"  =>  $style["property"],
                    "value"     =>  $style["value"],
                ));
            }
        }
        return redirect("/edit/style/default");
    }


    public function update(Request $request)
    {
        $form   =   $request->all();
        unset($form["_token"]);
        foreach($form as $id => $value){
            $style  =   WebsiteStyle::find($id);
            $style ? $style->fill(array("value"=>$value))->save() : null;
        }
        return response()->json(array("message"=>"success"), 200);
    }

    public function delete($id)
    {
        $style  =   WebsiteStyle::whereId($id)->whereCategory("customize")->first();
        $style ? $style->delete() : null;
        return redirect("/edit/style");
    }
}


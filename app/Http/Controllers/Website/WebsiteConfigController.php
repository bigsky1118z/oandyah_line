<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Website\WebsiteConfig;
use App\Models\Website\WebsitePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteConfigController extends Controller
{
    public function index()
    {
        $data   =   array(
            "header_logo_titles"    =>  WebsiteConfig::$header_logo_titles,
            "is_displays"           =>  WebsiteConfig::$is_displays,
            "membership_pages"      =>  WebsiteConfig::$membership_pages,
            "types"                 =>  WebsitePage::$types,
        );
        foreach(WebsiteConfig::configs() as $key => $value){
            $data[$key] =   $value;
        }
        return view("website.edit.config.index", $data);
    }

    public function create($config_name)
    {
        $data   =   array(
            "name"  =>  $config_name,
        );
        $config =   WebsiteConfig::whereName($config_name)->first();
        if($config){
            $data["value"]  =   $config->value;
            switch($config_name){
                case "header_logo_title":
                    $data["header_logo_titles"] =   WebsiteConfig::$header_logo_titles;
                    break;
                case "display_header_logo_title":
                case "display_header_image":
                        $data["is_displays"] =   WebsiteConfig::$is_displays;
                    break;
                case "membership_page":
                    $data["membership_pages"]   =   WebsiteConfig::$membership_pages;
                    break;
            }
            return view("website.edit.config.create", $data);
        } elseif(in_array($config_name, array_keys(WebsiteConfig::$images))){
            $data["value"]  =   WebsiteConfig::$images[$config_name];
            return view("website.edit.config.create", $data);
        }else {
            return back()->withInput();
        }
    }

    public function store(Request $request, $config_name)
    {
        if(WebsiteConfig::whereName($config_name)->exists() && $request->has("value")){
            $config =   WebsiteConfig::whereName($config_name)->first();
            $value  =   $request->get("value");
            $config->set_config($config_name, $value);
        } elseif(in_array($config_name, array_keys(WebsiteConfig::$images)) && $request->hasFile("value")){
            $path       =   "public/image/website";
            $file_name  =   WebsiteConfig::$images[$config_name];
            Storage::disk("local")->exists($path) ? null : Storage::disk("local")->makeDirectory($path, 0775, true);
            $request->file("value")->storeAs($path, $file_name);
        }
        return redirect("/edit/config");
    }
}

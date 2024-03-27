<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Website\Page\WebsitePageContactController;
use App\Http\Controllers\Website\Page\WebsitePageMultipleController;
use App\Http\Controllers\Website\Page\WebsitePageSingleController;
use App\Models\Website\WebsiteConfig;
use App\Models\Website\WebsitePage;
use App\Models\Website\WebsiteStyle;
use App\Models\Website\WebsiteLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class WebsiteController extends Controller
{
    public function index()
    {
        $data   =   array(
            "mains"  =>  WebsiteLayout::whereType("top")->whereTarget("main")->whereNotNull("order")->orderBy("order")->get(),
        );
        return view('website.index', $data);
    }
    public function edit()
    {
        $data   =   array(
            "edits" =>  WebsitePage::$edits,
        );
        return view('website.edit.index', $data);
    }

    public function redirect()
    {
        $data   =   array(
            "title"     =>  WebsiteConfig::get_config("title"),
            "h1"        =>  WebsiteConfig::get_config("h1"),

        );
        return view('website.redirect', $data);

    }

    public function get($path, $path1 = null, $path2 = null, $path3 = null)
    {
        $page   =   WebsitePage::wherePath($path)->first();
        if($page && $page->is_published() == "published"){
            $data   =   array(
                "page"  =>  $page,
            );
            switch($page->type){
                case("single"):
                    return App::Call([WebsitePageSingleController::class,"get"], $data);
                    break;
                case("multiple"):
                    $data["article_path"]   =   $path1;
                    // $data["action"]         =   $path2;
                    return App::Call([WebsitePageMultipleController::class,"get"], $data);
                    break;
                case("contact"):
                    return App::Call([WebsitePageContactController::class,"get"], $data);
                    break;
                default:
            }
        }
        return redirect("/redirect");
    }

    public function post(Request $request, $path, $path1 = null, $path2 = null, $path3 = null)
    {
        $page   =   WebsitePage::wherePath($path)->first();
        if($page){
            $data   =   array(
                "request"   =>  $request,
                "page"      =>  $page,
            );
            switch($page->type){
                case("regulated"):
                case("subsubdirectory"):
                    return back()->withInput();
                    break;
                case("single"):
                    return App::Call([WebsitePageSingleController::class,"post"], $data);
                    break;
                case("multiple"):
                    $data["article_path"]   =   $path1;
                    // $data["action"]         =   $path2;
                    return App::Call([WebsitePageMultipleController::class,"post"], $data);
                    break;
                case("contact"):
                    return App::Call([WebsitePageContactController::class,"post"], $data);
                    break;
                default:
            }
        }
        return redirect("/redirect");
    }


    public function style()
    {
        $data = array(
            "defaults"      =>  WebsiteStyle::whereCategory("default")->orderBy("selector")->get()->groupBy("selector"),
            "customizes"    =>  WebsiteStyle::whereCategory("customize")->orderBy("selector")->get()->groupBy("selector"),
        );
        $headers = array(
            "content-Type"          =>  "text/css",
            "content-Dispotition"   =>  "inline",
        );
        $response = response()->view("style", $data, 200, $headers);
        return $response;
    }
}

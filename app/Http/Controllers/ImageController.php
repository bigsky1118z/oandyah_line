<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function directory_index()
    {
        $path   =   "public/image";
        Storage::disk("local")->exists($path) ? null : Storage::disk("local")->makeDirectory($path, 0775, true);
        $directories    =   Storage::disk("local")->directories($path);
        $directories    =   array_filter($directories,fn($directory)=> !Str::contains($directory, 'website'));
        $data   =   array(
            "directories"   =>  $directories,
        );
        return view("website.edit.image.directory", $data);
    }

    public function directory_store(Request $request)
    {
        $directory  =   $request->get("directory");
        $path       =   "public/image/$directory";
        if(Storage::disk("local")->exists($path) || $directory == "all") {

        } elseif($directory == "website"){
            return back()->withInput();
        } else {
            Storage::disk("local")->makeDirectory($path, 0775, true);
        }
        return redirect("/edit/image/$directory");
    }

    public function directory_delete($directory)
    {
        if($directory == "website"){
            return back()->withInput();
        }
        $path   =   "public/image/$directory";
        if(Storage::disk("local")->exists($path)){
            Storage::disk("local")->deleteDirectory($path);
            return redirect("/edit/image");
        } else {
            return back()->withInput();
        }
    }


    public function file_index($directory)
    {
        if($directory == "website"){
            return back()->withInput();
        }
        $path   =   "public/image/$directory";
        $data   =   array(
            "directory" =>  $directory,
        );
        if($directory == "all"){
            $data["files"]  =   Storage::disk("local")->allFiles("public/image");
        }elseif($directory != "all" && Storage::disk("local")->exists($path)){
            $data["files"]  =   Storage::disk("local")->files($path);
        } else {
            return redirect("redirect");
        }
        if(isset($data["files"])){
            $data["files"] = array_filter($data["files"], function($file){
                $needles    =   array(".gitignore","public/image/website");
                return !Str::contains($file, $needles);
            });
        }
        return view("website.edit.image.file", $data);
    }

    public function file_store(Request $request, $directory)
    {
        if($directory == "website"){
            return response()->json(array("message"=>"指定されたディレクトリは使用できません"),400);
        }
        $path   =   "public/image/$directory";
        if(Storage::disk("local")->exists($path)){
        } else {
            Storage::disk("local")->makeDirectory($path, 0755, true);
        }
        if($request->hasFile("file")){
            $file_name  =   $request->file("file")->getClientOriginalName();
            if(Storage::disk("local")->exists($path . "/" . $file_name)){
                $file_info  =   pathinfo($file_name);
                $file_name  =   $file_info['filename'] . date("YmdHis") . '.' . $file_info['extension'];
            }
            $request->file("file")->storeAs($path,$file_name);
        }
        return response()->json(array("message"=>$file_name),200);
    }

    public function file_rename(Request $request, $directory)
    {
        if($directory == "website"){
            return response()->json(array("message"=>"指定されたディレクトリは使用できません"),400);
        }
        $path       =   "public/image/$directory";
        $data       =   array();
        if($request->has("filename") && $request->has("newname")){
            $pre_file_path  =   $path . "/" . $request->get("filename");
            $new_file_path  =   $path . "/" . $request->get("newname");
            if($pre_file_path == $new_file_path){
                $data["message"]    =   "元のファイル名と新しいファイル名が同じです。";
                return response()->json($data,400);
            }elseif(Storage::disk("local")->exists($new_file_path)){
                $data["message"]    =   "新しいファイル名は既に存在します。";
                return response()->json($data,400);
            }else{
                $data["message"]    =   "新しいファイル名に変更しました。";
                Storage::disk("local")->move($pre_file_path, $new_file_path);
                return response()->json($data,200);
            }
        }else{
            $data["message"]    =   "データに不足があります";
            return response()->json($data,400);
        }
    }

    public function file_delete($directory, $file_name)
    {
        if($directory == "website"){
            return back()->withInput();
        } else {
            $path   =   "public/image/$directory/$file_name";
            Storage::disk("local")->exists("$path") ? Storage::disk("local")->delete("$path") : null;
            return redirect("/edit/image/$directory");
        }
    }
}

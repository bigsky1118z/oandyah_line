<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\LineApiChannel;
use DragonCode\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class LineApiImageController extends Controller
{
    public function index($channel_name, $file_name = null)
    {
        $data   =   array(
            "channel"   =>  LineApiChannel::whereChannelName($channel_name)->first(),
            "edit"      =>  $file_name,
            "images"    =>  array(),
        );
        if(is_dir(storage_path("app/public/api/line/$channel_name"))){
            $data["files"]      =   File::files(public_path("storage/api/line/$channel_name"));
        }
        if(Storage::disk("local")->exists("/public/api/line/$channel_name")){
            $files  =   Storage::disk("local")->files("/public/api/line/$channel_name");
            foreach($files as $file){
                $data["images"][]   =   array(
                    "filename"      =>  basename($file),
                    "name"          =>  pathinfo($file, PATHINFO_FILENAME),
                    "extension"     =>  pathinfo($file, PATHINFO_EXTENSION),
                    "path"          =>  preg_replace("/public/", "storage", $file, 1),
                    "size"          =>  round((int) Storage::disk("local")->size($file) / 1024, 2),
                    "created_at"    =>  date("Y-m-d H:i", Storage::disk("local")->lastModified($file)),
                );
            }
        }
        return view("admin.api.line.image.index", $data);
    }

    public function store(Request $request, $channel_name)
    {

        if($request->hasFile('file')){
            $storage_path   =   storage_path("app/public/api/line/$channel_name");
            if(!is_dir($storage_path)){
                File::makeDirectory($storage_path, 0777, true);
            }
            $path   =   $request->file("file")->store("public/api/line/$channel_name");
            $json   =   array(
                "file_name" =>  basename($path),
            );
            return response()->json($json,200);
        }else{
            return back();
        }
    }

    public function rename(Request $request, $channel_name)
    {
        $data       =   array();
        if($request->has("filename") && $request->has("newname")){
            $file_path  =   "/public/api/line/$channel_name/" . $request->get("filename");
            $new_file_path  =   "/public/api/line/$channel_name/" . $request->get("newname");
            if($file_path == $new_file_path){
                $data["message"]    =   "新しいファイル名と元のファイル名が同じです";
                return response()->json($data,400);
            }elseif(Storage::disk("local")->exists($new_file_path)){
                $data["message"]    =   "そのファイル名はすでに存在します";
                return response()->json($data,400);
            }else{
                $data["message"]    =   "ファイル名を変更しました";
                Storage::disk("local")->move($file_path, $new_file_path);
                return response()->json($data,200);
            }
        }else{
            $data["message"]    =   "データに不足があります";
            return response()->json($data,400);
        }
    }


    public function delete(Request $request, $channel_name)
    {
        if($request->has("filename")){
            $file_name  =   $request->get("filename");
            if($file_name == "all"){
                $files  =   Storage::disk("local")->files("/public/api/line/$channel_name");
                foreach($files as $file){
                    Storage::disk("local")->delete($file);
                }
            }
            if($file_name != "all"){
                Storage::disk("local")->delete("/public/api/line/$channel_name/$file_name");
            }
            $data   =   array("filename" => $file_name);
            return response()->json($data,200);
        }else{
            return response()->json(array(),400);
        }
    }
}

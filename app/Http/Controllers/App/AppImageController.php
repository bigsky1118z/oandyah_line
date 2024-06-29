<?php

namespace App\Http\Controllers\App;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppImageController extends Controller
{
    public function index(Request $request, $user_name, $client_id, ...$pathes)
    {
        $user       =   User::find(auth()->user()->id);
        $app        =   $user->app($client_id)->app;
        $href       =   asset("$user_name/app/$client_id/image");
        $path       =   implode("/",$pathes);
        $directory  =   "public/app/$app->client_id/image";
        Storage::makeDirectory($directory);
        if(Storage::exists($directory. ($path ? "/$path" : null))){
            $directory  =   $directory . ($path ? "/$path" : null);
        }
        $directories    =   Storage::directories($directory);
        $directories    =   array_map(fn($directory_name)=>pathinfo($directory_name),$directories);
        $files          =   Storage::files($directory);
        $files          =   array_map(fn($file)=>pathinfo($file),$files);
        $data           =   array(
            "user"              =>  $user,
            "app"               =>  $app,
            "href"              =>  $href,
            "path"              =>  $path,
            "pathes"            =>  $pathes,
            "directories"       =>  $directories,
            "files"             =>  $files,
        );
        return view("app.image.index", $data);
    }

    public function store(Request $request, $user_name, $client_id, ...$pathes)
    {
        $user       =   User::find(auth()->user()->id);
        $app        =   $user->app($client_id)->app;
        $path       =   implode("/",$pathes);
        $directory  =   "public/app/$app->client_id/image";
        $href       =   asset("$user_name/app/$client_id/image");
        if($path){
            $directory  =   "$directory/$path";
            $href       =   "$href/$path";
        }
        if($request->exists("directory")){
            $new_directory  =   $request->input("directory");
            $href           =   "$href/$new_directory";
            Storage::makeDirectory("$directory/$new_directory");
        }
        if($request->hasFile("images")){
            $images      =   $request->file("images");
            foreach($images as $image){
                $size       =   $image->getSize();
                $mimetype   =   $image->getMimeType();
                if (($size < 1024 * 1024 * 5) && str_contains($mimetype, "image/")) {
                    $filename   =   $image->getClientOriginalName();
                    $new_name   =   $this->get_unique_filename($directory, $filename);
                    $image->storeAs($directory, $new_name);
                }
            }
        }
        if ($request->exists("rename")) {
            $basename   =   $request->input("basename");
            $extension  =   pathinfo($basename, PATHINFO_EXTENSION);
            $filename   =   $request->input("rename").".".$extension;
            $new_name   =   $this->get_unique_filename($directory, $filename);
            Storage::move("$directory/$basename", "$directory/$new_name");
        }
        return redirect($href);
    }

    
    public function destroy(Request $request, $user_name, $client_id, ...$pathes)
    {
        $user       =   User::find(auth()->user()->id);
        $app        =   $user->app($client_id)->app;
        $path       =   implode("/",$pathes);
        $href       =   asset("$user_name/app/$client_id/image");
        $directory  =   "public/app/$app->client_id/image";
        if($path){
            $directory  =   "$directory/$path";
        }
        if($request->exists("filename")){            
            $filename   =   $request->input("filename") ?? null;
            Storage::delete("$directory/$filename");
            if($path){
                $href  =   "$href/$path";
            }
        }
        if($request->exists("directory_name")){
            Storage::deleteDirectory($directory);
            array_pop($pathes);
            $path   =   implode("/",$pathes);
            if($path){
                $href  =   "$href/$path";
            }
        }
        return redirect($href);
    }

    private function get_unique_filename($directory, $filename)
    {
        $name       = pathinfo($filename, PATHINFO_FILENAME);
        $extension  = pathinfo($filename, PATHINFO_EXTENSION);
        $files      = Storage::files($directory);
        $files      = array_map(fn($file) => pathinfo($file), $files);
        $counter    = 1;
        $new_name   = $filename;
        while (collect($files)->contains(fn($file) => $file['basename'] == $new_name)) {
            $new_name = $name . "($counter)." . $extension;
            $counter++;
        }
        return $new_name;
    }
}

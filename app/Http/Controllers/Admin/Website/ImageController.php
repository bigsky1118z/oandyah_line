<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;

use App\Models\Website\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPSTORM_META\map;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Storage::files('public/images');
        $images = array_map(function($image){
            $image  = explode("/",$image);
            $name   = $image[2];
            $image  = array_replace($image,array(0=>"storage"));
            $image  = implode("/", $image);
            $image  = array(
                "src"   => $image,
                "name"  => $name,
            );
            return $image;
        },$images);
        $data = array(
            "images" => $images,
        );
        return view('admin.website.image.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $name = "image_".date('Ymdhis')."0";
        switch($file->getClientMimeType()){
            case('image/jpeg'):
                $name .= ".jpg";
                break;
            case('image/png'):
                $name .= ".png";
                break;
        }
        Storage::putFileAs('public/images', $file, $name);
        return redirect('/admin/website/image');
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        //
    }
}

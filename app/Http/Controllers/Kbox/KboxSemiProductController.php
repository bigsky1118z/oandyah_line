<?php

namespace App\Http\Controllers\Kbox;

use App\Http\Controllers\Controller;
use App\Models\Kbox\Product\KboxSemiProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SplFileObject;

class KboxSemiProductController extends Controller
{
    public function index()
    {
        $data   =   array(
            "semi_products" =>  KboxSemiProduct::orderBy("code")->get(),
        );
        return view("kbox.product.semi_product.index", $data);
    }

    public function export()
    {
        KboxSemiProduct::generate_csv();
        $headers    =   array(
            "Content-Type"  =>  "text/csv",
        );
        $path       =   "product";
        $contents   =   file_get_contents( "kbox_semi_products.csv");
        Storage::disk("kbox")->exists("$path/kbox_semi_products") ? null : Storage::disk("kbox")->makeDirectory("$path/kbox_semi_products", 0775, true);
        Storage::disk("kbox")->put($path . "/" .  "kbox_semi_products.csv", $contents);
        return response()->download( "kbox_semi_products.csv",  "kbox_semi_products.csv", $headers);
    }

    public function import(Request $request)
    {
        if($request->hasFile("csv")){
            $path   =   $request->file("csv")->path();
            $file   =   new SplFileObject($path);
            $file->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
            $semi_products  =   array();
            foreach($file as $row){
                $semi_products[] =   $row;
            }
            KboxSemiProduct::import_csv($semi_products);
            $data   =   array(
                "message" => "success",
            );
            return response()->json($data,200);
        }
    }

    public function delete($semi_product_id)
    {
        $user   =   auth()->user() ? User::find(auth()->user()->id) : null;
        
        if($user && array_intersect(array("all","provider"), $user->roles("kbox"))){
            $semi_product   =   KboxSemiProduct::find($semi_product_id);
            if($semi_product) {
                $semi_product->delete();
                return redirect("/kbox/product/semi_product");
            }
        }
        return back();
    }




    public function show($id)
    {
        $data   =   array(
            "semi_product"  =>  KboxSemiProduct::find($id),
        );
        return view("kbox.product.semi_product.show", $data);
    }
}

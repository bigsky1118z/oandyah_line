<?php

namespace App\Http\Controllers\Kbox;

use App\Http\Controllers\Controller;
use App\Models\Kbox\Company\KboxCompany;
use App\Models\Kbox\Product\KboxProduct;
use App\Models\Kbox\Sheet\KboxSheet;
use App\Models\Kbox\Sheet\KboxSheetGram;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SplFileObject;

class KboxProductController extends Controller
{

    public function index()
    {
        $data   =   array(
            "products"  =>  KboxProduct::orderBy("code")->get(),
        );
        return view("kbox.product.index", $data);
    }

    public function export()
    {
        KboxProduct::generate_csv();
        $headers    =   array(
            "Content-Type"  =>  "text/csv",
        );
        $path       =   "product";
        $contents   =   file_get_contents( "kbox_products.csv");
        Storage::disk("kbox")->exists("$path/kbox_products") ? null : Storage::disk("kbox")->makeDirectory("$path/kbox_products", 0775, true);
        Storage::disk("kbox")->put($path . "/" .  "kbox_products.csv", $contents);
        return response()->download( "kbox_products.csv",  "kbox_products.csv", $headers);
    }

    public function import(Request $request)
    {
        if($request->hasFile("csv")){
            $path       =   $request->file("csv")->path();
            $file       =   new SplFileObject($path);
            $file->setFlags(SplFileObject::READ_CSV | SplFileObject::READ_AHEAD | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
            $products   =   array();
            foreach($file as $row){
                $products[] =   $row;
            }
            KboxProduct::import_csv($products);
            $data   =   array(
                "message" => "success",
            );
            return response()->json($data,200);
        }
    }


    public function show($product_id)
    {
        $data   =   array(
            "product"  =>  KboxProduct::find($product_id),
        );
        return view("kbox.product.show", $data);
    }

    public function delete($product_id)
    {
        $user   =   auth()->user() ? User::find(auth()->user()->id) : null;
        
        if($user && array_intersect(array("all","provider"), $user->roles("kbox"))){
            $product    =   KboxProduct::find($product_id);
            if($product) {
                $product->delete();
                return redirect("/kbox/product");
            }
        }
        return back();
    }



}

<?php

namespace App\Http\Controllers\Admin\Webapp;

use App\Http\Controllers\Controller;
use App\Models\Webapp\ProductSemiProduct;
use App\Models\Webapp\Product;
use App\Models\Webapp\SemiProduct;
use Illuminate\Http\Request;

class SemiProductController extends Controller
{
    public function index(Request $request)
    {
        /**
         * Display a listing of the resource.
         */
        $query  =   $request->all();
        unset($query["_token"]);
        $semi_products = SemiProduct::query();
        foreach ($query as $key1 => $value1) {
            if ($value1) {
                if(is_array($value1)){
                    foreach($value1 as $key2 => $value2){
                        if($key2 == "over" &&$value2){
                            $semi_products->where($key1, '>=', $value2);
                        }
                        if($key2 == "under" &&$value2){
                            $semi_products->where($key1, '<=', $value2);
                        }
                    }
                } 
                if(!is_array($value1)){
                    $semi_products->where($key1, 'like', "%$value1%");
                }
            }
        }

        $semi_products  =   $semi_products->get();
    
        $data = array(
            "semi_products" =>  $semi_products,
            "query" =>  $query,
        );
    
        return view("admin.webapp.semi_product.index", $data);
    }    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data   =   array(
            "resource"  =>  "create",
            "products"      =>  Product::all(),
        );
        return view("admin.webapp.semi_product.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, SemiProduct::rules());
        $form           =   $request->except('_token');
        $semi_product   =   new SemiProduct();
        $semi_product->fill($form)->save();
        if(isset($form['products'])){
            if(isset($form['products']['add'])){
                $adds   =   array_filter($form['products']['add']);
                foreach($adds as $add){
                    if(!ProductSemiProduct::whereSemiProductId($semi_product->id)->whereSemiProductId($add)->exists()){
                        $product_semi_product       =   new ProductSemiProduct();
                        $product_semi_product->product_id       =   $add;
                        $product_semi_product->semi_product_id  =   $semi_product->id;
                        $product_semi_product->save();
                    }
                }
            }
        }
        return redirect('/admin/webapp/semi_product');
    }

    /**
     * Display the specified resource.
     */
    public function show(SemiProduct $semi_product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data   =   array(
            "semi_product"  =>  SemiProduct::find($id),
            "products"      =>  Product::all(),
            "resource"  =>  "edit",
        );
        return view("admin.webapp.semi_product.create",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request['id']    =   $id;
        $this->validate($request, SemiProduct::rules($id));
        $form       =   $request->except('_token');
        $semi_product    =   SemiProduct::find($id);
        $semi_product->fill($form)->save();
        if(isset($form['products'])){
            if(isset($form['products']['registed'])){
                $redisteds  =   array_filter($form['products']['registed']);
                foreach(ProductSemiProduct::whereSemiProductId($semi_product->id)->get() as $product_semi_product){
                    if(in_array($product_semi_product->product_id,$redisteds)){
                        continue;
                    } else {
                        $product_semi_product->delete();
                    }
                };
            }
            if(isset($form['products']['add'])){
                $adds   =   array_filter($form['products']['add']);
                foreach($adds as $add){
                    if(!ProductSemiProduct::whereSemiProductId($semi_product->id)->whereSemiProductId($add)->exists()){
                        $product_semi_product       =   new ProductSemiProduct();
                        $product_semi_product->product_id       =   $add;
                        $product_semi_product->semi_product_id  =   $semi_product->id;
                        $product_semi_product->save();
                    }
                }
            }
        }
        return redirect('/admin/webapp/semi_product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        foreach(ProductSemiProduct::whereSemiProductId($id)->get() as $product_semi_product){
            $product_semi_product->delete();
        }
        SemiProduct::find($id)->delete();
        return redirect('/admin/webapp/semi_product');
    }
}

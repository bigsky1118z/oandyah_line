<?php

namespace App\Http\Controllers\Admin\Webapp;

use App\Http\Controllers\Controller;
use App\Models\Webapp\ProductSemiProduct;
use App\Models\Webapp\Product;
use App\Models\Webapp\SemiProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query  =   $request->all();
        $products = Product::query();
        foreach ($query as $key1 => $value1) {
            if ($value1) {
                if(is_array($value1)){
                    foreach($value1 as $key2 => $value2){
                        if($key2 == "over" &&$value2){
                            $products->where($key1, '>=', $value2);
                        }
                        if($key2 == "under" &&$value2){
                            $products->where($key1, '<=', $value2);
                        }
                    }
                } 
                if(!is_array($value1)){
                    $products->where($key1, 'like', "%$value1%");
                }
            }
        }

        $products  =   $products->get();
    
        $data = array(
            "products" =>  $products,
            "query" =>  $query,
        );
    
        return view("admin.webapp.product.index", $data);
    }    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data   =   array(
            "resource"  =>  "create",
            "semi_products" =>  SemiProduct::all(),
        );
        return view("admin.webapp.product.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, Product::rules());
        $form       =   $request->except('_token');
        $product    =   new Product();
        $product->fill($form)->save();
        $code   =   $form['code'];
        $printing   =   $form['printing'];
        if(isset($form['semi_products'])){
            if(isset($form['semi_products']['add'])){
                $adds   =   array_filter($form['semi_products']['add']);
                foreach($adds as $add){
                    if(!ProductSemiProduct::whereProductId($product->id)->whereSemiProductId($add)->exists()){
                        $product_semi_product       =   new ProductSemiProduct();
                        $product_semi_product->product_id       =   $product->id;
                        $product_semi_product->semi_product_id  =   $add;
                        $product_semi_product->save();
                    }
                }
            }
            if(isset($form['semi_products']['new'])){
                foreach($form['semi_products']['new'] as $key => $value) {
                    switch($key){
                        case("buttom")  :
                            $form['code']       =   $code."a";
                            $form['semi_type']  =   "C式[ミ]";
                            $form['printing']   =   null;
                            break;
                        case("cover")  :
                            $form['code']       =   $code."b";
                            $form['semi_type']  =   "C式[フタ]";
                            $form['printing']   =   $printing;
                            break;
                        case("mount")  :
                            $form['code']       =   $code;
                            $form['semi_type']  =   $form["type"];
                            $form['printing']   =   $printing;
                            break;
                    }
                    if(!SemiProduct::whereCode($form['code'])->exists()){
                        $semi_product   =   new SemiProduct();
                        $semi_product->fill($form)->save();
                    } else {
                        $semi_product   =   SemiProduct::whereCode($form['code'])->first();
                    }
                    if(!ProductSemiProduct::whereProductId($product->id)->whereSemiProductId($semi_product->id)->exists()){
                        $product_semi_product       =   new ProductSemiProduct();
                        $product_semi_product->product_id       =   $product->id;
                        $product_semi_product->semi_product_id  =   $semi_product->id;
                        $product_semi_product->save();
                    }
                }
            }
        }

        if(isset($form['semi_product'])){
            foreach($form['semi_product'] as $key => $value) {
                $semi_product   =   new SemiProduct();
                switch($key){
                    case("buttom")  :
                        $form['code']       =   $code."a";
                        $form['semi_type']  =   "C式[ミ]";
                        $form['printing']   =   null;
                        break;
                    case("cover")  :
                        $form['code']       =   $code."b";
                        $form['semi_type']  =   "C式[フタ]";
                        $form['printing']   =   $printing;
                        break;
                    case("mount")  :
                        $form['code']       =   $code;
                        $form['semi_type']  =   $form["type"];
                        $form['printing']   =   $printing;
                        break;
            }
                $semi_product->fill($form)->save();
                $product_semi_product       =   new ProductSemiProduct();
                $product_semi_product->product_id       =   $product->id;
                $product_semi_product->semi_product_id  =   $semi_product->id;
                $product_semi_product->save();
            }
        } 
        return redirect('/admin/webapp/product');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data   =   array(
            "product"   =>  Product::find($id),
        );
        return view("admin.webapp.product.show",$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data   =   array(
            "product"       =>  Product::find($id),
            "semi_products" =>  SemiProduct::all(),
            "resource"      =>  "edit",
        );
        return view("admin.webapp.product.create",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request['id']    =   $id;
        $this->validate($request, Product::rules($id));
        $form       =   $request->except('_token');
        $product    =   Product::find($id);
        $product->fill($form)->save();
        $code   =   $form['code'];
        $printing   =   $form['printing'];
        if(isset($form['semi_products'])){
            if(isset($form['semi_products']['registed'])){
                $registeds  =   $form['semi_products']['registed'];
                foreach(ProductSemiProduct::whereProductId($product->id)->get() as $product_semi_product){
                    if(in_array($product_semi_product->semi_product_id,$registeds)){
                        continue;
                    } else {
                        $product_semi_product->delete();
                    }
                };
            }
            if(isset($form['semi_products']['add'])){
                $adds   =   array_filter($form['semi_products']['add']);
                foreach($adds as $add){
                    if(!ProductSemiProduct::whereProductId($product->id)->whereSemiProductId($add)->exists()){
                        $product_semi_product       =   new ProductSemiProduct();
                        $product_semi_product->product_id       =   $product->id;
                        $product_semi_product->semi_product_id  =   $add;
                        $product_semi_product->save();
                    }
                }
            }
            if(isset($form['semi_products']['new'])){
                foreach($form['semi_products']['new'] as $key => $value) {
                    switch($key){
                        case("buttom")  :
                            $form['code']       =   $code."a";
                            $form['semi_type']  =   "C式[ミ]";
                            $form['printing']   =   null;
                            break;
                        case("cover")  :
                            $form['code']       =   $code."b";
                            $form['semi_type']  =   "C式[フタ]";
                            $form['printing']   =   $printing;
                            break;
                        case("mount")  :
                            $form['code']       =   $code;
                            $form['semi_type']  =   $form["type"];
                            $form['printing']   =   $printing;
                            break;
                    }
                    if(!SemiProduct::whereCode($form['code'])->exists()){
                        $semi_product   =   new SemiProduct();
                        $semi_product->fill($form)->save();
                    } else {
                        $semi_product   =   SemiProduct::whereCode($form['code'])->first();
                    }
                    if(!ProductSemiProduct::whereProductId($product->id)->whereSemiProductId($semi_product->id)->exists()){
                        $product_semi_product       =   new ProductSemiProduct();
                        $product_semi_product->product_id       =   $product->id;
                        $product_semi_product->semi_product_id  =   $semi_product->id;
                        $product_semi_product->save();
                    }
                }
            }
        }
        return redirect('/admin/webapp/product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect('/admin/webapp/product');
    }
}

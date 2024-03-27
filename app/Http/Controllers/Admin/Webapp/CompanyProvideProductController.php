<?php

namespace App\Http\Controllers\Admin\Webapp;

use App\Http\Controllers\Controller;
use App\Models\Webapp\CompanyProvideProduct;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class CompanyProvideProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query      =   $request->all();
        if(!isset($query['order_by']) || !is_null($query['order_by'])){
            $query['order_by']  =   "company";
        }
        $provides   =   CompanyProvideProduct::query();
        $provides->join('companies', 'company_provide_products.company_id', '=', 'companies.id');
        $provides->join('products', 'company_provide_products.product_id', '=', 'products.id');
        foreach($query as $key => $value){
            if($value){
                switch($key){
                    case("company"):
                        if($value['input']){
                            $word   =   $value['input'];
                            $provides   =   $provides->where('companies.name', 'like', "%$word%")->orWhere('companies.kana', 'like', "%$word%");

                            // $words  =   array_filter(explode(" ",$value['input']));
                            // if($value['type'] == "and"){
                            //     foreach ($words as $word) {
                            //         $provides->where('companies.name', 'like', "%$word%")->orWhere('companies.kana', 'like', "%$word%");
                            //     }
                            // }
                            // if($value['type'] == "or"){
                            //     $provides->orWhere(function ($query) use ($words) {
                            //         foreach ($words as $word) {
                            //             $query->orWhere('companies.name', 'like', "%$word%")->orWhere('companies.kana', 'like', "%$word%");
                            //         }
                            //     });
                            // }
                        }
                        break;
                    case("product"):
                        if($value['input']){
                            $word   =   $value['input'];
                            $provides   =   $provides->where("products.code", 'like', "%$word%")->orWhere("products.company", 'like', "%$word%")->orWhere("products.name", 'like', "%$word%")->orWhere("products.color", 'like', "%$word%");
                            // $words  =   explode(" ",$value['input']);
                            // if($value['type'] == "and"){
                            //     foreach ($words as $word) {
                            //         $provides->where("products.code", 'like', "%$word%")->orWhere("products.company", 'like', "%$word%")->orWhere("products.name", 'like', "%$word%")->orWhere("products.color", 'like', "%$word%");
                            //     }
                            // }
                            // if($value['type'] == "or"){
                            //     $provides->where(function ($query) use ($words) {
                            //         foreach ($words as $word) {
                            //             $query->orWhere("products.code", 'like', "%$word%")->orWhere("products.company", 'like', "%$word%")->orWhere("products.name", 'like', "%$word%")->orWhere("products.color", 'like', "%$word%");
                            //         }
                            //     });
                            // }
                        }
                    break;
                    case("order_by"):
                        switch($value){
                            case("company"):
                                $provides->orderBy('companies.kana')->orderBy('products.code');
                            case("product"):
                                $provides->orderBy('products.code')->orderBy('companies.kana');
                                break;
                        }
                        break;
                }
            }
        }
        $provides->select('company_provide_products.*');
        $provides   =   $provides->get();
        $data       =   array(
            'provides'  =>  $provides,
            'query'     =>  $query,
        );
        return view("admin.webapp.provide.index", $data);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CompanyProvideProduct $companyProvideProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CompanyProvideProduct $companyProvideProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanyProvideProduct $companyProvideProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanyProvideProduct $companyProvideProduct)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\GlutenFree\Shop;

use App\Http\Controllers\Controller;
use App\Models\GlutenFree\Shop\GlutenFreeShop;
use Illuminate\Http\Request;

class GlutenFreeShopController extends Controller
{
    public function index()
    {
        $data   =   array(
            "shops" =>  GlutenFreeShop::all(),
        );
        return view("gluten_free.shop.index", $data);
    }
}

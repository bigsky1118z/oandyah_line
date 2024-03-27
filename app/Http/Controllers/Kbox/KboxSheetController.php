<?php

namespace App\Http\Controllers\Kbox;

use App\Http\Controllers\Controller;
use App\Models\Kbox\Sheet\KboxSheet;
use Illuminate\Http\Request;

class KboxSheetController extends Controller
{
    public function index()
    {
        $data   =   array(
            "sheets"    =>  KboxSheet::all(),
        );
        return view("kbox.sheet.index", $data);
    }

    public function show($sheet_id)
    {
        $data   =   array(
            "sheet" =>  KboxSheet::find($sheet_id),
        );
        return view("kbox.sheet.show", $data);
    }


}

<?php

namespace App\Http\Controllers\Admin;

use App\Library\CsvFile;
use App\Models\App;
use App\Models\App\AppFriend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index(Request $request)
    {
        $data   =   array(
            "tables"    =>  CsvFile::$tables,
        );
        return view("admin.backup.index", $data);
    }

    public function show(Request $request, $table_name){
        $table      =   CsvFile::get_table($table_name);
        $columns    =   CsvFile::get_columns($table_name);
        $model      =   $table ? ($table["model"] ?? null) : null;
        $file_names =   Storage::files("private/backup/$table_name");
        $data       =   array(
            "all"           =>  $model::all(),
            "columns"       =>  $columns,
            "table"         =>  $table,
            "file_names"    =>  $file_names,
        );
        return view("admin.backup.show", $data);
    }

    public function restoration(Request $request, $table_name)
    {
        $table      =   CsvFile::get_table($table_name);
        $model      =   $table ? ($table["model"] ?? null) : null;
        $file_name  =   $request->input("file_name");
        $file       =   Storage::get($file_name);
        $data       =   CsvFile::to_array($file);
        if($model){
            $model::restoration($data);
        }
        return redirect(asset("admin/backup/$table_name"));

    }

    public function backup(Request $request, $table_name){
        $table  =   CsvFile::get_table($table_name);
        $model  =   $table ? ($table["model"] ?? null) : null;
        if($model){
            $model::backup();
        }
        return redirect(asset("admin/backup"));
    }

    public function download(Request $request, $table_name){
        $table  =   CsvFile::get_table($table_name);
        $model  =   $table ? ($table["model"] ?? null) : null;
        if($model){
            return $model::download();
        } else {
            return redirect(asset("admin/backup"));
        }
    }


    public function redirect(Request $request)
    {
        return view("admin.redirect");
    }

}

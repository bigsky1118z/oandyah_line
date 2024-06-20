<?php

namespace App\Library;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvFile extends Facade
{
    public static function recovery($table_name)
    {
        $file   =   CsvFile::get_latest_file_from_storage_directory("backup",$table_name);
        if($file){
            
        }
        return $file;
    }
}
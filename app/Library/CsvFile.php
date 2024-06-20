<?php

namespace App\Library;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvFile extends Facade
{

    public static function to_array($csv_file)
    {
        $array      =   array_map(fn($row)=>explode(",",$row),preg_split("/\r\n|\n/", $csv_file));
        $headers    =   array_shift($array);
        $data       =   array_map(fn($datum)=>array_combine($headers,$datum),$array);
        return $data;
    }

    public static function to_csv_content($data){
        $csv_content    =   collect($data)->map(fn($row) => implode(',', $row))->implode("\r\n");
        return $csv_content;
    }

    public static function rebuilding_database($data, $table_name)
    {
        
    }

    public static function get_file_from_storage($disk = "local", $file_name, $directory = null)
    {
        $path   =   ($directory ? $directory . "/" : "") . $file_name;
        $file   =   Storage::disk($disk)->get($path);
        return $file;
    }

    public static function get_latest_file_from_storage_directory($disk = "local", $directory)
    {
        $files              =   Storage::disk($disk)->files($directory);
        $latest_modifieds   =   array();
        foreach($files as $file){
            $date                       =   Storage::disk($disk)->lastModified($file);
            $latest_modifieds[$date]    =   $file;
        }
        if(count($latest_modifieds)){
            $latest_key     =   max(array_keys($latest_modifieds));
            $latest_file    =   Storage::disk($disk)->get($latest_modifieds[$latest_key]);
            return $latest_file;
        } else {
            return null;
        }
    }


    public static function backup ($data, $table_name = null)
    {
        // 配列をCSVの形式にする
        $csv_content    =   self::to_csv_content($data);
        $path           =   ($table_name ? $table_name . "/" : null) . now()->format("YmdHis") . $table_name . ".csv";
        Storage::disk("backup")->makeDirectory($table_name);
        Storage::disk("backup")->put($path,$csv_content);
    }

    public static function download($data, $table_name = null)
    {
        $filename   =   now()->format("YmdHis") . $table_name . ".csv";
        $options    =   array(
            'Content-Type'          => 'text/csv',
            'Content-Disposition'   => 'attachment; filename="'. $filename. '"',
        );
        $download   =   new StreamedResponse(function() use ($data){
            $handle =   fopen("php://output", "w");
            foreach($data as $datum){
                fputcsv($handle, $datum);
            }
            fclose($handle);
        }, 200, $options);
        return $download;
    }

    public static function get_columns($table_name)
    {
        return Schema::getColumnListing($table_name);

    }
}
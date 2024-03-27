<?php

namespace App\Models\Kbox\Product;

use App\Models\Kbox\Company\KboxCompany;
use App\Models\Kbox\Sheet\KboxSheet;
use App\Models\Kbox\Sheet\KboxSheetGram;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KboxSemiProduct extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "code",
        "part",

        "kbox_company_id",
        "name",
        "classification",
        "extra",
        "color",
        "description",

        "kbox_sheet_gram_id",

        "length",
        "width",
        "height",
        "low_top",

        "processing",
    );

    public function company()
    {
        return $this->belongsTo(KboxCompany::class,"kbox_company_id");
    }

    public function sheet_gram()
    {
        return $this->belongsTo(KboxSheetGram::class,"kbox_sheet_gram_id");
    }

    public function display_name(){
        $display_name   =   "";
        if($this->company){
            $display_name   .= $this->company->name != "北角紙器" ? $this->company->name : "";
        }
        $display_name   .=  $display_name != "" && $this->name ? " " . $this->name : $this->name;
        $display_name   .=  $display_name != "" && $this->classification ? " " . $this->classification : $this->classification;
        $display_name   .=  $display_name != "" && $this->extra ? " " . $this->extra : $this->extra;
        $display_name   .=  $this->color != "" && $this->color != "無地" ? "(" . $this->color . ")" : "";
        $display_name   .=  "[" . $this->part . "]";
        return $display_name;
    }
    public function display_size(){
        $display_size   =   number_format($this->length, 0, ".", "");
        $display_size   .=  $display_size != "" && number_format($this->width, 0, ".", "") ? "×" . number_format($this->width, 0, ".", "") : number_format($this->width, 0, ".", "");
        $display_size   .=  $display_size != "" && number_format($this->height, 0, ".", "") ? "×" . number_format($this->height, 0, ".", "") : number_format($this->height, 0, ".", "");
        return $display_size;
    }


    public static function generate_csv()
    {
        $csv        =   fopen("kbox_semi_products.csv","w+");
        $semi_products  =   KboxSemiProduct::all();
        $headers        =   array("id", "code", "part", "kbox_company", "name", "classification", "extra", "color", "sheet", "gram", "length", "width", "height", "low_top", "processing");
        fputcsv($csv, $headers);
        foreach($semi_products as $semi_product){
            $array  =   array_map(function ($header) use ($semi_product){
                switch($header){
                    case "kbox_company":
                        if(isset($semi_product->company)){
                            return $semi_product->company->name;
                        } else {
                            return null;
                        }
                        break;
                    case "sheet":
                        if(isset($semi_product->sheet_gram)){
                            return $semi_product->sheet_gram->sheet->name;
                        } else {
                            return null;
                        }
                        break;
                    case "gram":
                        if(isset($semi_product->sheet_gram)){
                            return $semi_product->sheet_gram->gram;
                        } else {
                            return null;
                        }
                        break;
                    default:
                        if($semi_product[$header]){
                            return $semi_product[$header];
                        } else {
                            return null;
                        }
                }
            }, $headers);
            count($array) ? fputcsv($csv, $array) : null;
        }
        fclose($csv);
        return $csv;
    }

    public static function import_csv($semi_products)
    {
        $headers    =   array_shift($semi_products);
        foreach($semi_products as $semi_product){
            $code           =   $semi_product[array_search("code", $headers)];
            $part           =   $semi_product[array_search("part", $headers)];
            $kbox_company   =   KboxCompany::whereName($semi_product[array_search("kbox_company", $headers)])->first();
            $name           =   $semi_product[array_search("name", $headers)];
            if($code && $part && $kbox_company && $name){
                $sheet  =   KboxSheet::whereName($semi_product[array_search("sheet", $headers)])->first();
                if($sheet){
                    $sheet_gram =   KboxSheetGram::whereKboxSheetId($sheet->id)->whereGram($semi_product[array_search("gram", $headers)])->first();
                }    
                KboxSemiProduct::updateOrCreate(
                    array(
                        "code"                  =>  $code,
                        "part"                  =>  $part,
                        "kbox_company_id"       =>  $kbox_company->id,
                        "name"                  =>  $name,
                        "classification"        =>  $semi_product[array_search("classification", $headers)] ? $semi_product[array_search("classification", $headers)] : null,
                        "extra"                 =>  $semi_product[array_search("extra", $headers)] ? $semi_product[array_search("extra", $headers)] : null,
                        "color"                 =>  $semi_product[array_search("color", $headers)] ? $semi_product[array_search("color", $headers)] : null,
                        "description"           =>  $semi_product[array_search("description", $headers)] ? $semi_product[array_search("description", $headers)] : null,
                        "kbox_sheet_gram_id"    =>  isset($sheet->id) && isset($sheet_gram->id) ? $sheet_gram->id : null,
                        "length"                =>  $semi_product[array_search("length", $headers)] ? $semi_product[array_search("length", $headers)] : null,
                        "width"                 =>  $semi_product[array_search("width", $headers)] ? $semi_product[array_search("width", $headers)] : null,
                        "height"                =>  $semi_product[array_search("height", $headers)] ? $semi_product[array_search("height", $headers)] : null,
                        "low_top"               =>  $semi_product[array_search("low_top", $headers)] ? $semi_product[array_search("low_top", $headers)] : null,
                        "processing"            =>  $semi_product[array_search("processing", $headers)] ? $semi_product[array_search("processing", $headers)] : null,
                    ),
                    array()
                );
            }
        }

    }




}

<?php

namespace App\Models\Kbox\Product;

use App\Models\Kbox\Company\KboxCompany;
use App\Models\Kbox\Sheet\KboxSheet;
use App\Models\Kbox\Sheet\KboxSheetGram;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KboxProduct extends Model
{
    use HasFactory;
    
    protected $fillable =   array(
        "code",
        "kbox_company_id",
        "name",
        "classification",
        "extra",
        "description",
        "color",
        "type",
        "kbox_sheet_gram_id",
        "length",
        "width",
        "height",
        "low_top",
        "assemble",
        "cutting",
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

    public function semi_product()
    {
        // return $this->hasOne(KboxProductSemiProduct::class,"kbox_product_id");
        return $this->hasOne(KboxProductSemiProduct::class, "kbox_product_id");
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
        $csv        =   fopen("kbox_products.csv","w+");
        $products   =   KboxProduct::all();
        $headers    =   array("id", "code", "type", "kbox_company", "name", "classification", "extra", "color", "sheet", "gram", "length", "width", "height", "low_top", "assemble", "cutting", "processing");
        fputcsv($csv, $headers);
        foreach($products as $product){
            $array  =   array_map(function ($header) use ($product){
                switch($header){
                    case "kbox_company":
                        if(isset($product->company)){
                            return $product->company->name;
                        } else {
                            return null;
                        }
                        break;
                    case "sheet":
                        if(isset($product->sheet_gram)){
                            return $product->sheet_gram->sheet->name;
                        } else {
                            return null;
                        }
                        break;
                    case "gram":
                        if(isset($product->sheet_gram)){
                            return $product->sheet_gram->gram;
                        } else {
                            return null;
                        }
                        break;
                    default:
                        if($product[$header]){
                            return $product[$header];
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

    public static function import_csv($products)
    {
        $headers    =   array_shift($products);
        foreach($products as $product){
            $code           =   $product[array_search("code", $headers)];
            $type           =   $product[array_search("type", $headers)];
            $kbox_company   =   KboxCompany::whereName($product[array_search("kbox_company", $headers)])->first();
            $name           =   $product[array_search("name", $headers)];
            if($code && $type && $kbox_company && $name){
                $sheet  =   KboxSheet::whereName($product[array_search("sheet", $headers)])->first();
                if($sheet){
                    $sheet_gram =   KboxSheetGram::whereKboxSheetId($sheet->id)->whereGram($product[array_search("gram", $headers)])->first();
                }    
                KboxProduct::updateOrCreate(
                    array(
                        "code"                  =>  $code,
                        "type"                  =>  $type,
                        "kbox_company_id"       =>  $kbox_company->id,
                        "name"                  =>  $name,
                        "classification"        =>  $product[array_search("classification", $headers)] ? $product[array_search("classification", $headers)] : null,
                        "extra"                 =>  $product[array_search("extra", $headers)] ? $product[array_search("extra", $headers)] : null,
                        "color"                 =>  $product[array_search("color", $headers)] ? $product[array_search("color", $headers)] : null,
                        "description"           =>  $product[array_search("description", $headers)] ? $product[array_search("description", $headers)] : null,
                        "kbox_sheet_gram_id"    =>  isset($sheet->id) && isset($sheet_gram->id) ? $sheet_gram->id : null,
                        "length"                =>  $product[array_search("length", $headers)] ? $product[array_search("length", $headers)] : null,
                        "width"                 =>  $product[array_search("width", $headers)] ? $product[array_search("width", $headers)] : null,
                        "height"                =>  $product[array_search("height", $headers)] ? $product[array_search("height", $headers)] : null,
                        "low_top"               =>  $product[array_search("low_top", $headers)] ? $product[array_search("low_top", $headers)] : null,
                        "assemble"              =>  $product[array_search("assemble", $headers)] ? $product[array_search("assemble", $headers)] : null,
                        "cutting"               =>  $product[array_search("cutting", $headers)] ? $product[array_search("cutting", $headers)] : null,
                        "processing"            =>  $product[array_search("processing", $headers)] ? $product[array_search("processing", $headers)] : null,
                    ),
                    array()
                );
            }
        }

    }


}

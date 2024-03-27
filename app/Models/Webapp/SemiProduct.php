<?php

namespace App\Models\Webapp;

use App\Models\ProductSemiProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemiProduct extends Model
{
    use HasFactory;

    protected $fillable = array(
        'code',
        'semi_type',
        'company',
        'name',
        'color',
        'sheet',
        'gauge',
        'width',
        'length',
        'height',
        'cutting',
        'making',
        'printing',
    );

    public static $semi_types   =   array(
        "buttom"    =>  "C式[ミ]",
        "cover"     =>  "C式[フタ]",
        "mount"     =>  "台紙",
    );

    public static function rules($id = null)
    {
        $rules    =   array(
            'code'      =>  array('required','unique:products,code'.($id ? ',' . $id : '')),
            'company'   =>  array('required'),
        );
        return $rules;
    }


    public function get_display_name()
    {
        $display_name   =   array();
        if($this->company!="北角紙器"){
            array_push($display_name, $this->company);
            array_push($display_name, "別寸");
        }
        if($this->name){
            array_push($display_name, $this->name);
        }
        if($this->color){
            array_push($display_name, "($this->color)");
        }
        if($this->semi_type){
            $semi_type   =   substr($this->semi_type,strpos($this->semi_type,"["));
            array_push($display_name, $semi_type);
        }
        if (empty($display_name)) {
            $display_name   =   "---";
        } elseif (!empty($display_name)) {
            $display_name   =   implode(" ",$display_name);
        }
        return $display_name;
    }

    public function get_size()
    {
        $size   =   array((int) $this->width, (int) $this->length, (int) $this->height);
        $size   =   array_filter($size);
        if (empty($size)) {
            $size   =   "---";
        } elseif (!empty($size)) {
            $size   =   implode("x",$size);
        }
        return $size;
    }

    public function products()
    {
        return $this->hasMany(ProductSemiProduct::class);
    }
}

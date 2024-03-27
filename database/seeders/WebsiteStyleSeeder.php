<?php

namespace Database\Seeders;

use App\Models\Website\WebsiteStyle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->addStyle("default","*","margin","0");
        // $this->addStyle("default","*","padding","0");
        // $this->addStyle("default","body","width","100%");
        // $this->addStyle("default","body","max-width","1920px");

        // $this->addStyle("default","img","vertical-align","top");
        // $this->addStyle("default",".hidden","display","none !important");
        // $this->addStyle("default","textarea","resize","none");
        // $this->addStyle("default","table","width","100%");
        // $this->addStyle("default","a","text-decoration","unset");

        // $this->addStyle("default","footer","width","100%");
        // $this->addStyle("default","footer","max-width","1920px");

        // $this->addStyle("default","#copyright","font-size","10px");
        // $this->addStyle("default","#copyright","text-align","center");
        // $this->addStyle("default","#copyright","width","100%");

        $this->addStyle("default","a","color","unset");
        $this->addStyle("default","ul","list-style","none");

        // $this->addStyle("default","body","background-color","#999999");
        // $this->addStyle("default","header","background-color","#FFFF99");
        // $this->addStyle("default","main","background-color","unset");
        $this->addStyle("default","body","background","#ADA996");
        $this->addStyle("default","body","background","-webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #EAEAEA)");
        $this->addStyle("default","body","background","linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #EAEAEA)");
        $this->addStyle("default","header","background","#A6C0FE");
        $this->addStyle("default","header","background","-webkit-linear-gradient(120deg, #A6C0FE, #F68084)");
        $this->addStyle("default","header","background","linear-gradient(120deg, #A6C0FE, #F68084)");
        $this->addStyle("default","main","background","unset");
        $this->addStyle("default","footer","background","#F68084");
        $this->addStyle("default","footer","background","-webkit-linear-gradient(240deg, #F68084, #A6C0FE)");
        $this->addStyle("default","footer","background","linear-gradient(240deg, #F68084, #A6C0FE)");


        foreach (array("h1","h2","h3","h4","h5","h6","p","li") as $index => $selector) {
            $font_size  =   24-((int)$index*2) > 14 ? 24-((int)$index*2) . "px" : "14px" ;
            $this->addStyle("default",$selector,"font-size", $font_size);
            $this->addStyle("default",$selector,"color","#000000");
            $this->addStyle("default",$selector,"background-color","unset");
        }
    }

    public function addStyle($category, $selector, $property, $value)
    {
        WebsiteStyle::Create(array(
            "category"  =>  $category,
            "type"      =>  $category,
            "selector"  =>  $selector,
            "property"  =>  $property,
            "value"     =>  $value,
        ));
    }
}

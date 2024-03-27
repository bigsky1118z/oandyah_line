<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use App\Models\Website\Style;
use Illuminate\Http\Request;

use function Pest\Laravel\from;
use function Termwind\style;

class StyleController extends Controller
{
    public function response()
    {
        $data = array(
            'default_styles'    =>  Style::where('selector',"!=",'customize')->get()->groupBy('selector'),
            'customize_style'   =>  Style::where('selector','customize')->first(),
        );
        $headers = array(
            'content-Type'          =>  'text/css',
            'content-Dispotition'   =>  'inline',
        );
        $response = response()->view('style', $data, 200, $headers);
        return $response;
    }

    public function edit()
    {
        if(!Style::where('selector',"!=",'customize')->exists()){
            foreach(Style::$selectors as $section => $selectors){
                foreach($selectors as $selector => $title){
                    foreach(Style::$properties as $property => $value)
                    $default_styles =  new Style();
                    $default_styles->selector   =   $selector;
                    $default_styles->property   =   $property;
                    $default_styles->save();
                }
            }
        }
        if(!Style::where('selector','customize')->exists()){
            $customize_style =  new Style();
            $customize_style->selector  =   "customize";
            $customize_style->property  =   "customize";
            $customize_style->save();
        }
        $data = array(
            'default_styles'    =>  Style::where('selector',"!=",'customize')->get()->groupBy('selector'),
            'customize_style'   =>  Style::where('selector','customize')->first(),
            'selectors'         =>  Style::$selectors,
        );
        return view('admin.website.style.index', $data);
    }

    public function update(Request $request)
    {
        $styles =   $request->get('styles');
        if($styles){
            foreach($styles as $selector => $default_style){
                foreach($default_style as $property => $value){
                    $default    =   Style::whereSelector($selector)->whereProperty($property)->first();
                    if(!$default){
                        $default    =   new Style();
                        $default->selector  =   $selector;
                        $default->property  =   $property;
                    }
                    $default->value =   $value;
                    $default->save();
                }
            }
        }
        return redirect('/admin/website');
    }
}

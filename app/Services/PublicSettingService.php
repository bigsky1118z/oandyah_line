<?php
namespace App\Services;

class PublicSettingService
{
    public function base64_to_file($html)
    {
        $img_index = 0;
        $img_offset = 0;
        $count = 0;
        $imgs = array();

        while(strpos($html,'<img ',$img_offset)){
            $src = '';
            $file_name = '';
            $img_index = strpos($html,'<img ',$img_offset);
            $img_offset = strpos($html,'>',$img_index);
            $img = substr($html,$img_index,$img_offset-$img_index+1);
            $img_offset++;
            if(strpos($img,'src="')){
                $src_target = 'src="';
                $src_index = strpos($img,$src_target)+strlen($src_target);
                $src_offset = strpos($img,'"',$src_index);
                $src = substr($img,$src_index,$src_offset-$src_index);
                if(strpos($src,'base64')){
                    $base64_target = 'base64,';
                    $base64_index = strpos($src,$base64_target)+strlen($base64_target);
                    $base64_offset = strpos($src,'"',$base64_index);
                    $base64 = substr($src,$base64_index,$base64_offset-$base64_index);
                    $file_name = "image_".date('Ymdhis').$count;
                    if(strpos($src,'image/jpg')||strpos($src,'image/jpeg')){
                        $file_name .= '.jpg';
                    }else{
                        $file_name .= '.png';
                    }
                    file_put_contents("upload/img/".$file_name, base64_decode($base64));
                }
            }
            if($src && $file_name){
                $array = array(
                    'src'   =>  $src,
                    'file'  =>  "/upload/img/".$file_name,
                );
                array_push($imgs , $array);
                $count++;
            }
        }
        foreach($imgs as $img){
            $html = str_replace($img['src'],$img['file'],$html);
        }
        return $html;
    }
}
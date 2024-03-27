<?php

namespace App\Models\JingujiOzora;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class JingujiOzora extends Model
{
    use HasFactory;

    public static $tarot_spreads    =   array(
        "one_card"      =>  array(
            "name"  =>  "one_card",
            "title" =>  "ワンカード",
            "count" =>  1,
        ),
        "three_cards"   =>  array(
            "name"  =>  "three_cards",
            "title" =>  "スリーカード",
            "count" =>  3,
        ),
        "horseshoe"     =>  array(
            "name"  =>  "horseshoe",
            "title" =>  "ホースシュー",
            "count" =>  7,
        ),
        "hexagram"      =>  array(
            "name"  =>  "hexagram",
            "title" =>  "ヘキサグラム",
            "count" =>  7,
        ),
        "celtic_cross"  =>  array(
            "name"  =>  "celtic_cross",
            "title" =>  "ケルト十字",
            "count" =>  10,
        ),
    );

    public static $prefectures  =   array(
        "北海道"    =>  array("latitude"    =>  43.064359,  "longitude" =>  141.347449),
        "青森県"    =>  array("latitude"    =>  40.824294,  "longitude" =>  140.740054),
        "岩手県"    =>  array("latitude"    =>  39.70353,   "longitude" =>  141.152667),
        "宮城県"    =>  array("latitude"    =>  38.268737,  "longitude" =>  140.872183),
        "秋田県"    =>  array("latitude"    =>  39.718175,  "longitude" =>  140.103356),
        "山形県"    =>  array("latitude"    =>  38.240127,  "longitude" =>  140.362533),
        "福島県"    =>  array("latitude"    =>  37.750146,  "longitude" =>  140.466754),
        "茨城県"    =>  array("latitude"    =>  36.341817,  "longitude" =>  140.446796),
        "栃木県"    =>  array("latitude"    =>  36.56575,   "longitude" =>  139.883526),
        "群馬県"    =>  array("latitude"    =>  36.391205,  "longitude" =>  139.060917),
        "埼玉県"    =>  array("latitude"    =>  35.857771,  "longitude" =>  139.647804),
        "千葉県"    =>  array("latitude"    =>  35.604563,  "longitude" =>  140.123179),
        "東京都"    =>  array("latitude"    =>  35.689185,  "longitude" =>  139.691648),
        "神奈川県"  =>  array("latitude"    =>  35.447505,  "longitude" =>  139.642347),
        "新潟県"    =>  array("latitude"    =>  37.901699,  "longitude" =>  139.022728),
        "富山県"    =>  array("latitude"    =>  36.695274,  "longitude" =>  137.211302),
        "石川県"    =>  array("latitude"    =>  36.594729,  "longitude" =>  136.62555),
        "福井県"    =>  array("latitude"    =>  36.06522,   "longitude" =>  136.221641),
        "山梨県"    =>  array("latitude"    =>  35.665102,  "longitude" =>  138.568985),
        "長野県"    =>  array("latitude"    =>  36.651282,  "longitude" =>  138.180972),
        "岐阜県"    =>  array("latitude"    =>  35.39116,   "longitude" =>  136.722204),
        "静岡県"    =>  array("latitude"    =>  34.976987,  "longitude" =>  138.383057),
        "愛知県"    =>  array("latitude"    =>  35.180247,  "longitude" =>  136.906698),
        "三重県"    =>  array("latitude"    =>  34.730547,  "longitude" =>  136.50861),
        "滋賀県"    =>  array("latitude"    =>  35.004532,  "longitude" =>  135.868588),
        "京都県"    =>  array("latitude"    =>  35.0209962, "longitude" =>  135.7531135),
        "大阪府"    =>  array("latitude"    =>  34.686492,  "longitude" =>  135.518992),
        "兵庫県"    =>  array("latitude"    =>  34.69128,   "longitude" =>  135.183087),
        "奈良県"    =>  array("latitude"    =>  34.685296,  "longitude" =>  135.832745),
        "和歌山県"  =>  array("latitude"    =>  34.224806,  "longitude" =>  135.16795),
        "鳥取県"    =>  array("latitude"    =>  35.503463,  "longitude" =>  134.238258),
        "島根県"    =>  array("latitude"    =>  35.472248,  "longitude" =>  133.05083),
        "岡山県"    =>  array("latitude"    =>  34.66132,   "longitude" =>  133.934414),
        "広島県"    =>  array("latitude"    =>  34.396033,  "longitude" =>  132.459595),
        "山口県"    =>  array("latitude"    =>  34.185648,  "longitude" =>  131.470755),
        "徳島県"    =>  array("latitude"    =>  34.065732,  "longitude" =>  134.559293),
        "香川県"    =>  array("latitude"    =>  34.34014,   "longitude" =>  134.04297),
        "愛媛県"    =>  array("latitude"    =>  33.841649,  "longitude" =>  132.76585),
        "高知県"    =>  array("latitude"    =>  33.55969,   "longitude" =>  133.530887),
        "福岡県"    =>  array("latitude"    =>  33.606767,  "longitude" =>  130.418228),
        "佐賀県"    =>  array("latitude"    =>  33.249367,  "longitude" =>  130.298822),
        "長崎県"    =>  array("latitude"    =>  32.744542,  "longitude" =>  129.873037),
        "熊本県"    =>  array("latitude"    =>  32.790385,  "longitude" =>  130.742345),
        "大分県"    =>  array("latitude"    =>  33.2382,    "longitude" =>  131.612674),
        "宮崎県"    =>  array("latitude"    =>  31.91109,   "longitude" =>  131.423855),
        "鹿児島県"  =>  array("latitude"    =>  31.560219,  "longitude" =>  130.557906),
        "沖縄県"    =>  array("latitude"    =>  26.211538,  "longitude" =>  127.681115),
    );

    public static $planets  =   array(
        'Sun'   =>  array(
            "code"  =>  10,
            "name"  =>  'Sun',
            "title" =>  '太陽',
        ),
        'Moon'  =>  array(
            "code"  =>  301,
            "name"  =>  'Moon',
            "title" =>  '月',
        ),
        'Mercury'   =>  array(
            "code"  =>  199,
            "name"  =>  'Mercury',
            "title" =>  '水星',
        ),
        'Venus' =>  array(
            "code"  =>  299,
            "name"  =>  'Venus',
            "title" =>  '金星',
        ),
        'Earth' =>  array(
            "code"  =>  399,
            "name"  =>  'Earth',
            "title" =>  "地球",
        ),
        'Mars'  =>  array(
            "code"  =>  499,
            "name"  =>  'Mars',
            "title" =>  '火星',
        ),
        'Jupiter'   =>  array(
            "code"  =>  599,
            "name"  =>  'Jupiter',
            "title" =>  '木星',
        ),
        'Saturn'    =>  array(
            "code"  =>  699,
            "name"  =>  'Saturn',
            "title" =>  '土星',
        ),
        'Uranus'    =>  array(
            "code"  =>  799,
            "name"  =>  'Uranus',
            "title" =>  '天皇星',
        ),
        'Neptune'   =>  array(
            "code"  =>  899,
            "name"  =>  'Neptune',
            "title" =>  '海王星',
        ),
        'Pluto' =>  array(
            "code"  =>  999,
            "name"  =>  'Pluto',
            "title" =>  '冥王星',
        ),
    );

    public static $signs    =   array(
        'Aries'    =>  array(
            "title"         =>  '牡羊座',
            "title_kana"    =>  'おひつじ座',
            "title_formal"  =>  '白羊宮',
            "name"          =>  'Aries',
            "name_short"    =>  'Ari',
            "icon"          =>  '♈',
            "degree"        =>  0,
        ),
        'Taurus'  =>  array(
            "title"         =>  '牡牛座',
            "title_kana"    =>  'おうし座',
            "title_formal"  =>  '金牛宮',
            "name"          =>  'Taurus',
            "name_short"    =>  'Tau',
            "icon"          =>  '♉',
            "degree"        =>  30,
        ),
        'Gemini'  =>  array(
            "title"         =>  '双子座',
            "title_kana"    =>  'ふたご座',
            "title_formal"  =>  '双児宮',
            "name"          =>  'Gemini',
            "name_short"    =>  'Gem',
            "icon"          =>  '♊',
            "degree"        =>  60,
        ),
        'Cancer'    =>  array(
            "title"         =>  '蟹座',
            "title_kana"    =>  'かに座',
            "title_formal"  =>  '巨蟹宮',
            "name"          =>  'Cancer',
            "name_short"    =>  'Cnc',
            "icon"          =>  '♋',
            "degree"        =>  90,
        ),
        'Leo'    =>  array(
            "title"         =>  '獅子座',
            "title_kana"    =>  'しし座',
            "title_formal"  =>  '獅子宮',
            "name"          =>  'Leo',
            "name_short"    =>  'Leo',
            "icon"          =>  '♌',
            "degree"        =>  120,
        ),
        'Virgo'  =>  array(
            "title"         =>  '乙女座',
            "title_kana"    =>  'おとめ座',
            "title_formal"  =>  '処女宮',
            "name"          =>  'Virgo',
            "name_short"    =>  'Vir',
            "icon"          =>  '♍',
            "degree"        =>  150,
        ),
        'Libra'    =>  array(
            "title"         =>  '天秤座',
            "title_kana"    =>  'てんびん座',
            "title_formal"  =>  '天秤宮',
            "name"          =>  'Libra',
            "name_short"    =>  'Lib',
            "icon"          =>  '♎',
            "degree"        =>  180,
        ),
        'Scorpio'  =>  array(
            "title"         =>  '蠍座',
            "title_kana"    =>  'さそり座',
            "title_formal"  =>  '天蝎宮',
            "name"          =>  'Scorpio',
            "name_short"    =>  'Sco',
            "icon"          =>  '♏',
            "degree"        =>  210,
        ),
        'Sagittarius'    =>  array(
            "title"         =>  '射手座',
            "title_kana"    =>  'いて座',
            "title_formal"  =>  '人馬宮',
            "name"          =>  'Sagittarius',
            "name_short"    =>  'Sgr',
            "icon"          =>  '♐',
            "degree"        =>  240,
        ),
        'Capricorn'    =>  array(
            "title"         =>  '山羊座',
            "title_kana"    =>  'やぎ座',
            "title_formal"  =>  '磨羯宮',
            "name"          =>  'Capricorn',
            "name_short"    =>  'Cap',
            "icon"          =>  '♑',
            "degree"        =>  270,
        ),
        'Aquarius'    =>  array(
            "title"         =>  '水瓶座',
            "title_kana"    =>  'みずがめ座',
            "title_formal"  =>  '宝瓶宮',
            "name"          =>  'Aquarius',
            "name_short"    =>  'Aqr',
            "icon"          =>  '♒',
            "degree"        =>  300,
        ),
        'Pisces'    =>  array(
            "title"         =>  '魚座',
            "title_kana"    =>  'うお座',
            "title_formal"  =>  '双魚宮',
            "name"          =>  'Pisces',
            "name_short"    =>  'Psc',
            "icon"          =>  '♓',
            "degree"        =>  330,
        ),
    );

    public static function get_planet_signs($birthday, $longitude, $latitude){
        $planets    =   self::$planets;
        $signs      =   self::$signs;
        $planet_signs   =   array();
        foreach($planets as $planet_key => $planet){
            if($planet_key == "Earth"){
                continue;
            }
            $url        =   "https://ssd.jpl.nasa.gov/api/horizons.api?format=text";
            $url        .=  "&COMMAND=" . $planet['code'];
            $url        .=  "&OBJ_DATA='YES'";
            $url        .=  "&MAKE_EPHEM='YES'";
            $url        .=  "&EPHEM_TYPE='OBSERVER'";
            $url        .=  "&CENTER=coord@399";
            $url        .=  "&SITE_COORD='$longitude,$latitude,0'";
            $url        .=  "&START_TIME='$birthday'";
            $url        .=  "&STOP_TIME='$birthday:01'";
            $url        .=  "&QUANTITIES='31'";
    
            $response   =   Http::get($url);

            preg_match('/\$\$SOE\n (.*?)\n\$\$EOE/s', $response, $matches);
            if(isset($matches[1])){
                $parts  =   explode(" ",preg_replace('/\s+/', ' ', $matches[1]));
                $degree =   array_slice($parts, -2)[0];
                foreach($signs as $sign_key => $sign){
                    if($sign["degree"] <= $degree && $degree < $sign["degree"] + 30 ) {
                        $planet_sign    =   array(
                            "planet"    =>  $planet_key,
                            "sign"      =>  $sign_key,
                            "degree"    =>  $degree,
                        );
                        $planet_signs[$planet_key]  =   $planet_sign;            
                        break;
                    }else{
                        continue;
                    }
                }
            }
        }
        return $planet_signs;
    }
        

}
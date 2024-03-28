<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserName extends Model
{
    use HasFactory;

    protected $fillable =   [
        "user_id",
        "last_name_jp",
        "last_name_kana",
        "last_name_en",
        "middle_name_jp",
        "middle_name_kana",
        "middle_name_en",
        "first_name_jp",
        "first_name_kana",
        "first_name_en",
        "maiden_name_jp",
        "maiden_name_kana",
        "maiden_name_en",
        "nickname",
        "naming",
        "honorific_title",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function full_name($type = null)
    {
        $full_name  =   "";
        $name_array =   array();
        switch($type) {
            case "en":
                $name_array =   array("first_name_en", "middle_name_en", "last_name_en");
                break;
            case "kana":
            case "jp":
                $name_array =   array("last_name_". $type, "middle_name_". $type, "first_name_". $type);
                break;
            default:
                $name_array =   array("last_name_jp", "middle_name_jp", "first_name_jp");
                break;
        }
        foreach($name_array as $name){
            if($full_name == ""){
                $full_name .=   $this[$name];
            } else {
                $full_name .=   $this[$name] ? " " . $this[$name] : "";
            }
        }
        return $full_name;
    }

    public function nickname()
    {
        $nickname   =   $this->nickname;
        $nickname   =   $nickname ? $nickname : $this->full_name();
        $nickname   =   $nickname ? $nickname : $this->user->email;
        return $nickname;
    }

}

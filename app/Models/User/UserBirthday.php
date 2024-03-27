<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBirthday extends Model
{
    use HasFactory;
    protected $fillable =   array(
        "user_id",
        "year",
        "month",
        "day",
        "hours",
        "minutes",
        "place",
    );

    public function birthday($type = "day")
    {
        $birthday   =   "";
        switch($type) {
            case "day":
                $birthday   .=   $this->year ? $this->year : "9999";
                $birthday   .=   "-";
                $birthday   .=   $this->month ? $this->month : "99";
                $birthday   .=   "-";
                $birthday   .=   $this->day ? $this->day : "99";
                break;
            case "time":
                $birthday   .=   $this->hours ? $this->hours : "99";
                $birthday   .=   ":";
                $birthday   .=   $this->minutes ? $this->minutes : "99";
                break;
            case "full":
            default:
                $birthday   .=  $this->birthday("day") . " " . $this->birthday("time");
                break;
        }
        return $birthday;
    }
}

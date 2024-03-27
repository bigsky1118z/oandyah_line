<?php

namespace App\Models\Sns;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SnsConfig extends Model
{
    use HasFactory;
    protected $fillable =   array(
        "sns_id",
        "name",
        "value",
    );

    public static $types    =   array(
        "list"  =>  "リスト",
        "card"  =>  "カード",
    );

}

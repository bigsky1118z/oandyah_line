<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdirectory extends Model
{
    use HasFactory;
    protected $fillable =   array(
        "value",
    );
    public static $subdirectories =   array(
        "website",
        "gluten_free",
        "jinguji_ozora",
        "kbox",
        "pokemon",
    );


    public function roles(){
        return $this->hasMany(SubdirectoryRole::class, "subdirectory_id");
    }

}

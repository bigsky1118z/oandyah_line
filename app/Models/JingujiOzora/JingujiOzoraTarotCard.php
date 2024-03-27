<?php

namespace App\Models\JingujiOzora;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JingujiOzoraTarotCard extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "image_url",
        "arcana",
        "title_jp",
        "name_jp",
        "number_jp",
        "title_en",
        "name_en",
        "number_en",
    );

}

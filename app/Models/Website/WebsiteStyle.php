<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteStyle extends Model
{
    use HasFactory;
    
    protected $fillable =   array(
        "category",
        "type",
        "selector",
        "property",
        "value",
    );

}

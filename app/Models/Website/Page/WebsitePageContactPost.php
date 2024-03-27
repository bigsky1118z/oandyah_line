<?php

namespace App\Models\Website\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePageContactPost extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "website_page_contact_id",
        "values",
        "status",
    );

    protected $casts    =   array(
        "values" =>  "json",
    );

    public static $statuses =   array(
        "pending"       =>  "未対応",
        "resolved"      =>  "対応済",
        "not_needed"    =>  "対応不要",
    );

}

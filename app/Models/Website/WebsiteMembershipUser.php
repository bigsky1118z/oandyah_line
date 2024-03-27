<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteMembershipUser extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "website_membership_id",
        "user_id",
    );

}

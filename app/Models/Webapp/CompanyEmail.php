<?php

namespace App\Models\Webapp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyEmail extends Model
{
    use HasFactory;

    protected $fillable =   array(
        'type',
        'email',
        'name',
    );
}

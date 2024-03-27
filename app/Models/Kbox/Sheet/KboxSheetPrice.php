<?php

namespace App\Models\Kbox\Sheet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KboxSheetPrice extends Model
{
    use HasFactory;
    
    protected $fillable =   array(
        "kbox_sheet_id",
        "purchase",
        "subcontractor",
        "estimate",
        "valid_at",
    );
}

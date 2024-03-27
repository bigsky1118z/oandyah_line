<?php

namespace App\Models\Line\Message;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineMessageText extends Model
{
    use HasFactory;
    protected $fillable =   array(
        "line_id",
        "name",
        "status",
        "validate",
        "text",
        "emojis",
    );

    protected $casts    =   array(
        "emojis"    =>  "json",
    );

    public function get_object()
    {
        if($this->text){
            $object =   array(
                "type"      =>  "text",
                "text"      =>  $this->text,
                "emojis"    =>  $this->emojis   ? $this->emojis : null,
            );
            return $object;
        } else {
            return null;
        }
    }
    public function get_html()
    {
        return "<p>$this->text</p>";
    }
}

<?php

namespace App\Models\Line\Message;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineMessageImage extends Model
{
    use HasFactory;

    protected $fillable =   array(
        "line_id",
        "name",
        "status",
        "validate",
        "original_content_url",
        "preview_image_url",
    );

    public function get_object()
    {
        if($this->original_content_url){
            $object =   array(
                "type"                  =>  "image",
                "originalContentUrl"    =>  $this->original_content_url,
                "previewImageUrl"       =>  $this->preview_image_url    ? $this->preview_image_url : $this->original_content_url,
            );
            return $object;
        } else {
            return null;
        }
    }
    public function get_html()
    {
        return "<img src='$this->original_content_url' alt='$this->name' width='100' height='100'>";
    }

}

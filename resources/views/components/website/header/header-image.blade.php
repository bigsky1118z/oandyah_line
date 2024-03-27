@php
    use App\Models\Website\WebsiteConfig;    
    $path   =   Request::path();
@endphp
@props(array(
    // "is_display"   =>  true,
    "is_display"    =>  WebsiteConfig::is_display("header_image", $path),
    "url"           =>  null,
))
@if ($is_display && $url)
    <div id="header-image"><img src="{{ $url }}"></div>
@endif
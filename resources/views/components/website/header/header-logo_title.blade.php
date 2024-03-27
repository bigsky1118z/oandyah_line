@php
    use App\Models\Website\WebsiteConfig;    
@endphp
@props(array(
    "title"             =>  WebsiteConfig::whereName("title")->exists() ? WebsiteConfig::whereName("title")->first()->value : "",
    "header_logo_title" =>  WebsiteConfig::whereName("header_logo_title")->exists() ? WebsiteConfig::whereName("header_logo_title")->first()->value : "",
    "is_display"        =>  WebsiteConfig::is_display("header_logo_title", Request::path()),
))
@php
    $values     =   explode("-", $header_logo_title);
    $classes    =   array();
    foreach ($values as $value) {
        in_array($value, array("fixed", "left", "right")) ? $classes[]  =   "header-logo_title-" . $value : null;
    }
    $classes    =   implode(" ", $classes);
@endphp
@if ($is_display)
    <div id="header-logo_title" class="{{ $classes }} {{ $header_logo_title=='none' ? 'hidden' : null }}">
        <h1>
            <a href="/">
                <img id="header-logo" class="{{ in_array('logo', $values) ? null : 'hidden' }}" src="{{ file_exists(public_path("storage/image/website/logo.png")) ? "/storage/image/website/logo.png" : null }}" alt="{{ in_array('title', $values) ? null : $title }}">
                <span id="header-title" class="{{ in_array('title', $values) ? null : 'hidden' }}">{{ $title }}</span>
            </a>
        </h1>
    </div>
    @if (in_array('fixed', $values))
        <div id="header-blank"></div>
    @endif
@endif
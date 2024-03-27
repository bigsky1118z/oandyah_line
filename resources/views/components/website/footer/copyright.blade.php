@php
    use App\Models\Website\WebsiteConfig;
@endphp
@props(array(
    "title" =>  WebsiteConfig::whereName("title")->exists() ? WebsiteConfig::whereName("title")->first()->value : "",
))
<div id="copyright">
    <span>Copyright {{ $title }}&copy; {{ date("Y") }} All Rights Reserved</span>
</div>
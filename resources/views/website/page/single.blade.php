@php
    use App\Models\Website\WebsiteConfig;
    $option =   WebsiteConfig::whereName("layout_single")->exists() ? WebsiteConfig::whereName("layout_single")->first()->value : "layout-01";
@endphp
<x-website.frame.basic>
<x-slot name="id">single</x-slot>
@if ($page->description)
    <x-slot name="description">{{ $page->description }}</x-slot>
@elseif(isset($page->single))
    <x-slot name="description">{{ strip_tags($page->single->body) }}</x-slot>
@endif
<x-slot name="title">{{ $page->title }}</x-slot>
{{-- <x-slot name="head"></x-slot> --}}
{{-- <x-slot name="h1"></x-slot> --}}

<x-slot name="imageheaderurl">{{ $page->image_header_url }}</x-slot>
<x-slot name="header"></x-slot>
{{-- <x-slot name="h2"></x-slot> --}}
@if (file_exists(resource_path("views/components/website/main/single/$option.blade.php")))
    @switch($option)
        @case("layout-001")
            <x-website.main.single.layout-001 :page="$page" />
            @break
        {{-- @case("layout-002")
            <x-website.main.single.layout-002 :page="$page" />
            @break --}}
        @default
            <x-website.main.single.layout-000 :page="$page" />
    @endswitch
@else
    <x-website.main.single.layout-000 :page="$page" />
@endif
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>
</x-website.frame.basic>
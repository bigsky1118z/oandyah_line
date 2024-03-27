@if(isset($page) && $page->is_published() == "published")
    @switch($page->type)
        @case("menu")
            <x-website.header.menu :page="$page" :option="$option" />
            @break
        {{-- @case("image")
            <x-website.top.header.image :option="$option" :page="$page" />
            @break --}}
        {{-- @case("single")
            @break
        @case("multple")
            @break --}}
        @default
            @break
    @endswitch
@endif
@php
    use App\Models\Website\WebsitePage;
    use App\Models\Website\WebsiteLayout;

    $type       =   WebsitePage::get_type(Request::path()) ? WebsitePage::get_type(Request::path()) : "default";
    $headers    =   WebsiteLayout::whereType($type)->whereTarget("header")->whereNotNull("order")->get();
@endphp
@if($headers->count())
    @foreach ($headers as $header)
        @php
            $page   =   $header->page;
            $option =   $header->option;
        @endphp
        @if(isset($page) && $page->is_published() == "published")
            @switch($page->type)
                @case("menu")
                    <x-website.header.menu :page="$page" :option="$option" />
                    @break
                @default
                    @break
            @endswitch
        @endif
    @endforeach        
@endif





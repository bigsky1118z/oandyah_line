@if(isset($page) && $page->is_published() == "published")
    <div class="footer-column" id="{{ $page->path }}">
        @switch($page->type)
            @case("menu")
                <x-website.footer.menu :option="$option" :page="$page" />
                @break
            @case("image")
                @break
            @case("single")
                @break
            @case("multple")
                @break
            @default
                @break
        @endswitch
    </div>
@endif
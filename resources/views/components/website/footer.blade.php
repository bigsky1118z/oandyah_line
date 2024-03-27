@php
    use App\Models\Website\WebsitePage;
    use App\Models\Website\WebsiteLayout;

    $type       =   WebsitePage::get_type(Request::path()) ? WebsitePage::get_type(Request::path()) : "default";
    $footers    =   WebsiteLayout::whereType($type)->whereTarget("footer")->whereNotNull("order")->get();
@endphp
@if($footers->count())
    <div id="footer-columns">
        @if ($footers->count() == 1)
            <div class="footer-column"></div>
            <div class="footer-column"></div>
        @endif
        @foreach ($footers as $footer)
            @php
                $page   =   $footer->page;
                $option =   $footer->option;
            @endphp
            @if(isset($page) && $page->is_published() == "published")
                @switch($page->type)
                    @case("menu")
                        <x-website.footer.menu :page="$page" :option="$option" />
                        @break
                    @default
                        @break
                @endswitch
            @endif
        @endforeach
    </div>
@endif
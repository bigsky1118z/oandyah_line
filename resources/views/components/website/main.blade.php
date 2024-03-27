@if(isset($page) && $page->is_published() == "published")
    <section id="{{ $page->path }}">
        @switch($page->type)
            @case("single")
                <x-website.main.index.single :page="$page" :option="$option" />
                @break
            @case("multiple")
                <x-website.main.index.multiple :page="$page" :option="$option" />
                @break
            @case("menu")
                <x-website.main.index.menu :page="$page" :option="$option" />
                @break
            @default
        @endswitch
    </section>
@endif
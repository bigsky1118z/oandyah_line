@if(isset($page->menu) && $page->menu->links->count())
    @switch($option)
        {{-- @case("menu-bar")
            <div class="footer-menu-bar">
                <nav>
                    <ul>
                        @foreach ($page->menu->links as $link)
                            <li><a href="/{{ $link->path }}">{{ $link->title }}</a></li>
                        @endforeach
                    </ul>
                </nav>
            </div>
            @break --}}
        {{-- @case("menu-card100x100")
            <div class="footer-menu-card100x100">
                @foreach ($page->menu->links as $link)
                    <dl onclick="location.href='{{ $link->path }}'">
                        <dd><img src="{{ $menu->image_url ? $menu->image_url : "https://pbs.twimg.com/profile_images/1683899100922511378/5lY42eHs_400x400.jpg" }}"></dd>
                        <dt>{{ $link->title }}</dt>
                    </dl>
                @endforeach
            </div>
            @break --}}
        @case("default")
        @default
            <dl class="footer-menu">
                @foreach ($page->menu->links as $link)
                    <dd><a href="{{ $link->path }}">{{ $link->title }}</a></dd>
                @endforeach
            </dl>
            @break
    @endswitch
@endif
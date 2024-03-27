@if(isset($page->menu) && $page->menu->links->count())
    @switch($option)
        {{-- @case("menu-bar")
            <div class="menu-bar">
                <nav>
                    <ul>
                        @foreach ($page->menus as $menu)
                            <li><a href="/{{ $menu->get_path() }}">{{ $menu->get_title() }}</a></li>
                        @endforeach
                    </ul>
                </nav>
            </div>
            @break --}}
        {{-- @case("menu-card100x100")
            <div class="menu-card100x100">
                @foreach ($page->menus as $menu)
                    <dl onclick="location.href='{{ $menu->get_path() }}'">
                        <dd><img src="{{ $menu->image_url ? $menu->image_url : "https://pbs.twimg.com/profile_images/1683899100922511378/5lY42eHs_400x400.jpg" }}"></dd>
                        <dt>{{ $menu->get_title() }}</dt>
                    </dl>
                @endforeach
            </div>
            @break --}}
        @case("default")
        @default
            <dl class="header-menu">
                @foreach ($page->menu->links as $link)
                    <dd><a href="{{ $link->path }}">{{ $link->title }}</a></dd>
                @endforeach
            </dl>
    @endswitch
@endif
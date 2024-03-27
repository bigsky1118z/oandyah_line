@if (isset($page->menu) && $page->menu->links->count())
    <div class="top-menu">
        <dl class="dl-top-menu-link{{ $option == "default" ? null : " dl-top-menu-link-$option" }}">
            @foreach ($page->menu->links()->orderBy("order")->get() as $link)
                <dd class="dd-top-menu-link-values">
                    <a href="{{ $link->path }}">
                        <span class="span-top-menu-link-values-title">{{ $link->title }}</span>
                        @if (in_array($option, array("description")))
                            <span class="span-top-menu-link-values-description">{!! nl2br($link->description) !!}</span>
                        @endif
                    </a>
                </dd>
            @endforeach
        </dl>
    </div>
@endif
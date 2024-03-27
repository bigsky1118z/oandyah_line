@switch($option)
    @case("default")
    @default
        <div class="top-single">
            <h2>{{ $page->title }}</h2>
            <div class="body">{!! $page->single->body !!}</div>
        </div>
@endswitch
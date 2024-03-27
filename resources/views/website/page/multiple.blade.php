<x-website.frame.basic>
<x-slot name="id">multiple</x-slot>
@if ($page->description)
    <x-slot name="description">{{ $page->description }}</x-slot>
@endif
<x-slot name="title">{{ $page->title }}</x-slot>
{{-- <x-slot name="head"></x-slot> --}}
{{-- <x-slot name="h1"></x-slot> --}}
<x-slot name="header"></x-slot>
<x-slot name="imageheaderurl">{{ $page->image_header_url }}</x-slot>
<x-slot name="h2">{{ $page->title }}</x-slot>
<section id="index">
    <dl id="dl-multiple-index">
        <dt class="dt-multiple-index-header"></dt>
        @if (isset($page->multiple) && $page->multiple->published_articles()->count())
            @foreach ($page->multiple->published_articles()->orderBy("valid_at", "desc")->orderBy("id", "desc")->paginate(10) as $article)
                @if ($article->is_published() == "published")
                    <dd class="dd-multiple-index-body">
                        <dl>
                            <dd class="dd-multiple-index-body-thumbnail">
                                <img src="{{ $article->image_thumbnail_url ? $article->image_thumbnail_url : '/storage/image/website/no_image.png' }}">
                            </dd>
                            <dd class="dd-multiple-index-body-values">
                                <dl>
                                    <dd class="dd-multiple-index-body-values-title"><h3><a href="/{{ $page->path }}/{{ $article->path }}">{{ $article->title }}</a></h3></dd>
                                    <dd class="dd-multiple-index-body-values-article">{{ Str::limit(trim(strip_tags($article->body)), 203, '...') }}</dd>
                                    <dd class="dd-multiple-index-body-values-date">{{ $article->valid_at }}</dd>
                                </dl>
                            </dd>
                        </dl>
                    </dd>
                @else
                    <p>membership</p>
                @endif
            @endforeach
            <dd>{{ $page->multiple->published_articles()->orderBy("valid_at", "desc")->orderBy("id", "desc")->paginate(10)->links() }}</dd>
        @else
            <p>投稿がありません</p>
        @endif
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>
</x-website.frame.basic>
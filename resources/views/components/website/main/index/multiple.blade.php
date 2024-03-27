@php
    list($option, $num) = count(explode("-", $option)) == 2 ? explode("-", $option) : array("default","5");
@endphp
@if(isset($page->multiple) && $page->multiple->published_articles()->count())
    <div class="top-multiple">
        <h2>{{ $page->title }}</h2>
        <dl class="dl-top-multiple-article{{ $option == "default" ? null : " dl-top-multiple-article-$option" }}">
            @foreach ($page->multiple->published_articles()->orderBy("valid_at", "desc")->orderBy("id", "desc")->paginate((int)$num) as $article)
                <dd class="dd-top-multiple-article-values{{ $option == "card" || $option == "card_title" ?  " card-$num" : null }}">
                    <dl>
                        @if (!in_array($option, array("card", "card_title")))
                            <dd class="dd-top-multiple-article-values-date">{{ (new DateTime($article->valid_at))->format('Y-m-d H:i') }}</dd>
                        @endif
                        @if (!in_array($option, array("card")))
                            <dt class="dt-top-multiple-article-values-title"><a href="/{{ $page->path }}/{{ $article->path }}">{{ $article->title }}</a></dt>
                        @endif
                    </dl>
                    @if (in_array($option, array("article")))
                        <dl>
                            <dd class="dd-top-multiple-article-values-article">{{ strip_tags($article->body) }}</dd>
                        </dl>
                    @endif
                    @if (in_array($option, array("card", "card_title")))
                        <img class="img-top-multiple-article-values-card" src="{{ $article->image_thumbnail_url ? $article->image_thumbnail_url : '/storage/image/website/no_image.png' }}" alt="" onclick="location.href='/{{ $page->path }}/{{ $article->path }}'">
                    @endif
                </dd>
            @endforeach
        </dl>
        <p class="p-top-multiple-article-list"><a href="/{{ $page->path }}">>>{{ $page->title }}一覧</a></p>
    </div>
@endif
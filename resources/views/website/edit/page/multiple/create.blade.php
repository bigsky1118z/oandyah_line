@php
    $values =   array(
        "page_type" =>  "multiple",
    );
    if(isset($page)){
        $columns    =   array("id","type","path","title","image_thumbnail_url","image_header_url","description","status","valid_at","expired_at");
        foreach ($columns as $column) {
            $values["page_" . $column]  =   $page[$column];
        }
    }
    if(count(old())) {
        $values =   old();
    }
@endphp
<x-website.frame.edit>
<x-slot name="title">multiple</x-slot>
<x-slot name="id">multiple</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/edit/page">ページ</a> > <a href="/edit/page/multiple">複合ページ</a> > {{ isset($values['page_path']) ? $values['page_path'] : "create" }}</x-slot>
<section id="create">
    <h3>mulitple {{ isset($values['page_id']) && $values['page_id'] ? "edit" : "create" }}</h3>
    <form action="/edit/page/multiple{{ isset($values['page_id']) && $values['page_id'] ? '/' . $values['page_id'] : null }}" method="post">
        @csrf
        <h4>ページ設定</h4>
        <x-website.edit.dl_page_config :values="$values" />
    </form>
</section>
@if (isset($page))
<section id="index">
    <h4>記事一覧</h4>
    <p><button type="button" onclick="location.href='/edit/page/multiple/{{ $page->id }}/create'">create</button></p>
    <dl id="dl-multiple_article-index">
        @if ($page->multiple->articles->count())
            <dt>
                <dl class="dl-flex dl-multiple_article-index-header">
                    <dd class="dd-multiple_article-index-path">path</dd>
                    <dd class="dd-multiple_article-index-title">title</dd>
                    <dd class="dd-multiple_article-index-body">body</dd>
                    <dd class="dd-multiple_article-index-publish">publish</dd>
                    <dd class="dd-multiple_article-index-button">button</dd>
                </dl>
            </dt>
            @foreach ($page->multiple->articles as $article)
            <dd>
                <dl class="dl-flex dl-multiple_article-index-body">
                    <dd class="dd-multiple_article-index-path">{{ isset($article->path) ? $article->path : null }}</dd>
                    <dd class="dd-multiple_article-index-title">{{ isset($article->title) ? $article->title : null }}</dd>
                    <dd class="dd-multiple_article-index-body">{{ isset($article->body) ? Str::limit(trim(strip_tags($article->body)), 43, '...') : null }}</dd>
                    <dd class="dd-multiple_article-index-publish">{{ $article->is_published("jp") }}</dd>
                    <dd class="dd-multiple_article-index-button">
                        <button type="button" onclick="location.href = '/edit/page/multiple/{{ $page->id }}/{{ $article->id }}/edit'">edit</button>
                        <button type="button" onclick="location.href = '/edit/page/multiple/{{ $page->id }}/{{ $article->id }}/delete'">delete</button>
                    </dd>
                </dl>
            </dd>
            @endforeach
        @else
            <dd>記事はありません</dd>
        @endif
    </dl>
</section>
@endif
<x-slot name="script">
</x-slot>
</x-website.frame.edit>
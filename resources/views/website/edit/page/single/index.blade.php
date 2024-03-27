<x-website.frame.edit>
<x-slot name="title">single</x-slot>
<x-slot name="id">single</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/edit/page">ページ</a> > 単独ページ</x-slot>
<section id="index">
    <h3>単独ページ 一覧</h3>
    <p><button type="button" onclick="location.href='/edit/page/single/create'">create</button></p>
    <dl id="dl-single-index">
        <dt>
            <dl class="dl-flex dl-single-index-header">
                <dd class="dd-single-index-page_path">page_path</dd>
                <dd class="dd-single-index-page_title">page_title</dd>
                <dd class="dd-single-index-body">body</dd>
                <dd class="dd-single-index-publish">publish</dd>
                <dd class="dd-single-index-button">button</dd>
            </dl>
        </dt>
        @foreach ($pages as $page)
        <dd>
            <dl class="dl-flex dl-single-index-body">
                <dd class="dd-single-index-page_path">{{ isset($page->path) ? $page->path : null }}</dd>
                <dd class="dd-single-index-page_title">{{ isset($page->title) ? $page->title : null }}</dd>
                <dd class="dd-single-index-body">{{ isset($page->single) && isset($page->single->body) ? Str::limit(trim(strip_tags($page->single->body)), 43, '...') : null }}</dd>
                <dd class="dd-single-index-publish">{{ $page->is_published("jp") }}</dd>
                <dd class="dd-single-index-button">
                    <button type="button" onclick="location.href = '/edit/page/single/{{ $page->id }}/edit'">edit</button>
                    <button type="button" onclick="location.href = '/edit/page/single/{{ $page->id }}/delete'">delete</button>
                </dd>
            </dl>
        </dd>
        @endforeach
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>    
    
</x-website.frame.edit>
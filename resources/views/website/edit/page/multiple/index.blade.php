<x-website.frame.edit>
<x-slot name="title">multiple</x-slot>
<x-slot name="id">multiple</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/edit/page">ページ</a> > 複合ページ</x-slot>
<section id="index">
    <h3>複合ページ 一覧</h3>
    <p><button type="button" onclick="location.href='/edit/page/multiple/create'">新規作成</button></p>
    <dl id="dl-multiple-index">
        <dt>
            <dl class="dl-flex dl-multiple-index-header">
                <dd class="dd-multiple-index-page_path">page_path</dd>
                <dd class="dd-multiple-index-page_title">page_title</dd>
                <dd class="dd-multiple-index-articles">articles</dd>
                <dd class="dd-multiple-index-button">button</dd>
            </dl>
        </dt>
        @foreach ($pages as $page)
        <dd>
            <dl class="dl-flex dl-multiple-index-body">
                <dd class="dd-multiple-index-page_path">{{ isset($page->path) ? $page->path : null }}</dd>
                <dd class="dd-multiple-index-page_title">{{ isset($page->title) ? $page->title : null }}</dd>
                <dd class="dd-multiple-index-articles">{{ isset($page->multiple) ? $page->multiple->articles->count() : 0 }}</dd>
                <dd class="dd-multiple-index-button">
                    {{-- <button type="button" onclick="location.href = '/edit/page/multiple/{{ $page->id }}'">show</button> --}}
                    <button type="button" onclick="location.href = '/edit/page/multiple/{{ $page->id }}/edit'">edit</button>
                    <button type="button" onclick="location.href = '/edit/page/multiple/{{ $page->id }}/delete'">delete</button>
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
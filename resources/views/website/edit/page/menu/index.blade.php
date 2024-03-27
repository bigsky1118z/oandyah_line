<x-website.frame.edit>
<x-slot name="title">menu</x-slot>
<x-slot name="id">menu</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/edit/page">ページ</a> > メニューページ</x-slot>
<section id="index">
    <h3>メニューページ 一覧</h3>
    <p><button type="button" onclick="location.href='/edit/page/menu/create'">create</button></p>
    <dl id="dl-menus">
        <dt>
            <dl class="dl-flex dl-menu-index-header">
                <dd class="dd-menu-index-page_path">page_path</dd>
                <dd class="dd-menu-index-page_title">page_title</dd>
                <dd class="dd-menu-index-links">links</dd>
                <dd class="dd-menu-index-button">button</dd>
            </dl>
        </dt>
        @foreach ($pages as $page)
        <dd>
            <dl class="dl-flex dl-menu-index-body">
                <dd class="dd-menu-index-page_path">{{ isset($page->path) ? $page->path : null }}</dd>
                <dd class="dd-menu-index-page_title">{{ isset($page->title) ? $page->title : null }}</dd>
                <dd class="dd-menu-index-links">{{ isset($page->menu) ? $page->menu->links->count() : 0 }}</dd>
                <dd class="dd-menu-index-button">
                    {{-- <button type="button" onclick="location.href = '/edit/page/menu/{{ $page->id }}'">show</button> --}}
                    <button type="button" onclick="location.href = '/edit/page/menu/{{ $page->id }}/edit'">edit</button>
                    <button type="button" onclick="location.href = '/edit/page/menu/{{ $page->id }}/delete'">delete</button>
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
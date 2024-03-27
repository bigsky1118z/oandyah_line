@php
    $values =   array(
        "page_type" =>  "menu",
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
<x-slot name="title">menu</x-slot>
<x-slot name="id">menu</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/edit/page">ページ</a> > <a href="/edit/page/menu">メニューページ</a> > {{ isset($values['page_path']) ? $values['page_path'] : "create" }}</x-slot>
<section id="create">
    <h3>mulitple {{ isset($values['page_id']) && $values['page_id'] ? "edit" : "create" }}</h3>
    <form action="/edit/page/menu{{ isset($values['page_id']) && $values['page_id'] ? '/' . $values['page_id'] : null }}" method="post">
        @csrf
        <h4>ページ設定</h4>
        {{ $values["page_type"] }}
        <x-website.edit.dl_page_config :values="$values" />
    </form>
</section>
@if (isset($page))
<section id="index">
    <h4>リンク</h4>
    <p><button type="button" onclick="location.href='/edit/page/menu/{{ $page->id }}/link'">edit</button></p>
    <dl id="dl-menu_link-index">
        @if ($page->menu->links->count())
            <dt>
                <dl class="dl-flex dl-menu_link-index-header">
                    <dd class="dd-menu_link-index-path">path</dd>
                    <dd class="dd-menu_link-index-title">title</dd>
                    <dd class="dd-menu_link-index-description">description</dd>

                </dl>
            </dt>
            @foreach ($page->menu->links()->orderBy("order")->get() as $link)
            <dd>
                <dl class="dl-flex dl-menu_link-index-body">
                    <dd class="dd-menu_link-index-path">{{ isset($link->path) ? $link->path : null }}</dd>
                    <dd class="dd-menu_link-index-title">{{ isset($link->title) ? $link->title : null }}</dd>
                    <dd class="dd-menu_link-index-description">{{ isset($link->description) ? $link->description : null }}</dd>
                </dl>
            </dd>
            @endforeach
        @else
            <dd>項目はありません</dd>
        @endif
    </dl>
</section>
@endif
<x-slot name="script">
</x-slot>
</x-website.frame.edit>
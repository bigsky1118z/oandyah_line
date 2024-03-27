@php
    $values =   array(
        "page_type" =>  "single",
    );
    if(isset($page)){
        $columns    =   array("id","type","path","title","image_thumbnail_url","image_header_url","description","status","valid_at","expired_at");
        foreach ($columns as $column) {
            $values["page_" . $column]  =   $page[$column];
        }
        if($page->single){
            $values["body"] =   $page->single->body;
        }
    }
    if(count(old())) {
        $values =   old();
    }
@endphp
<x-website.frame.edit>
<x-slot name="title">single</x-slot>
<x-slot name="id">single</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/edit/page">ページ</a> > <a href="/edit/page/single">単独ページ</a> > {{ isset($values['page_path']) ? $values['page_path'] : "create" }}</x-slot>
<section id="create">
    <h3>single {{ isset($values['page_id']) && $values['page_id'] ? "edit" : "create" }}</h3>
    <form action="/edit/page/single{{ isset($values['page_id']) && $values['page_id'] ? '/' . $values['page_id'] : null }}" method="post">
        @csrf
        <x-website.edit.dl_page_config :values="$values" />
        <dl>
            <dt><h4>ページ編集</h4></dt>
            <dd>
                <dl class="dl-flex dl-single-create-body">
                    <dt class="dt-single-create-item">本文</dt>
                    <dd class="dd-single-create-value"><textarea name="body">@isset($values["body"]){{ $values["body"] }}@endisset</textarea></dd>
                </dl>
            </dd>
            <dd>
                <dl class="dl-flex dl-single-create-body">
                    <dt class="dt-single-create-item"></dt>
                    <dd class="dd-single-create-value"><button type="submit">save</button></dd>
                </dl>
            </dd>
        </dl>
    </form>
</section>
<x-slot name="script">
</x-slot>
</x-website.frame.edit>
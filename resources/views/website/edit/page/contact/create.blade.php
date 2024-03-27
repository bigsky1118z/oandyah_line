@php
    $values =   array(
        "page_type" =>  "contact",
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
<x-slot name="title">contact</x-slot>
<x-slot name="id">contact</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/edit/page">ページ</a> > <a href="/edit/page/contact">問い合わせページ</a> > {{ isset($values['page_title']) ? $values['page_title'] : "新規作成" }}</x-slot>
<section id="create">
    <h3>問い合わせページ {{ isset($values['page_id']) && $values['page_id'] ? "編集" : "新規作成" }}</h3>
    <form action="/edit/page/contact{{ isset($values['page_id']) && $values['page_id'] ? '/' . $values['page_id'] : null }}" method="post">
        @csrf
        <h4>ページ設定</h4>
        <x-website.edit.dl_page_config :values="$values" />
    </form>
</section>
@if (isset($page))
<section id="post-data">
    <dl class="dl-title-button">
        <dd><h4>投稿</h4></dd>
        <dd><button type="button" onclick="location.href='/edit/page/contact/{{ $page->id }}/post'">投稿一覧</button></dd>
    </dl>
    <dl>
        <dt>
            <dl class="dl-flex">
                @foreach ($post_statuses as $key => $value)
                    <dd class="dl-content-post-data-{{ $key }}">{{ $value }}</dd>
                @endforeach
            </dl>
        </dt>
        <dd>
            <dl class="dl-flex">
                @foreach ($post_statuses as $key => $value)
                    <dd class="dl-content-post-data-{{ $key }}">{{ $page->contact->posts()->whereStatus($key)->count() }}</dd>
                @endforeach
            </dl>
        </dd>
    </dl>
</section>
<section id="form-index">
    <dl class="dl-title-button">
        <dd><h4>フォーム</h4></dd>
        <dd><button type="button" onclick="location.href='/edit/page/contact/{{ $page->id }}/form'">フォーム編集</button></dd>
    </dl>
    <p></p>
    <dl id="dl-contact-form-index">
        @if ($page->contact->forms->count())
            <dt>
                <dl class="dl-contact-form-index-header">
                    <dd class="dd-contact-form-index-name">項目</dd>
                    <dd class="dd-contact-form-index-title">タイトル</dd>
                    <dd class="dd-contact-form-index-description">概要</dd>
                    <dd class="dd-contact-form-index-required">必須</dd>

                </dl>
            </dt>
            @foreach ($page->contact->forms as $form)
                @if ($form->active)
                    <dd>
                        <dl class="dl-contact-form-index-body">
                            <dd class="dd-contact-form-index-name">{{ isset($form_values[$form->name], $form_values[$form->name]["title"]) ? $form_values[$form->name]["title"] : $form->name }}</dd>
                            <dd class="dd-contact-form-index-title">{{ $form->title }}</dd>
                            <dd class="dd-contact-form-index-description">{{ $form->description }}</dd>
                            <dd class="dd-contact-form-index-required">{{ $form->required ? "◎" : null }}</dd>
                        </dl>
                    </dd>
                @endif
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
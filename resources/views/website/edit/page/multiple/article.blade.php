@php
    $values =   array();
    if(isset($page)) {
        $columns    =   array("id","path");
        foreach ($columns as $column) {
            $values["page_" . $column]  =   $page[$column];
        }
    }
    if(isset($article)){
        $columns    =   array("id","path","title","image_thumbnail_url","image_header_url","body","status","valid_at","expired_at");
        foreach ($columns as $column) {
            $values["article_" . $column]  =   $article[$column];
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
<x-slot name="h2"><a href="/edit/page">ページ</a> > <a href="/edit/page/multiple">複合ページ</a>{!! isset($values["page_id"]) && isset($values["page_title"]) ? ' > <a href="/edit/page/multiple/' . $values["page_id"] .'/edit">' . $values["page_title"] . '</a>' : null !!}</a></x-slot>
<section id="create">
    <form action="/edit/page/multiple/{{ $values['page_id'] }}/{{ isset($values['article_id']) && $values['article_id'] ? $values['article_id'] : "new_article" }}" method="post">
        @csrf
        <dl id="dl-multiple-create-multiple_article">
            <dt><h3>記事設定</h3></dt>
            <dd>
                <dl class="dl-flex dl-multiple-cretate-multiple_article-body">
                    <dt class="dt-multiple-create-multiple_article-item">path</dt>
                    <dd class="dd-multiple-create-multiple_article-value"><span>https://*****.***/{{ $values["page_path"] }}/</span><input type="text" name="article_path" value="{{ isset($values['article_path']) ? $values['article_path'] : null }}" required></dd>
                </dl>
            </dd>
            <dd>
                <dl class="dl-flex dl-multiple-cretate-multiple_article-body">
                    <dt class="dt-multiple-create-multiple_article-item">title</dt>
                    <dd class="dd-multiple-create-multiple_article-value"><input type="text" name="article_title" value="{{ isset($values['article_title']) ? $values['article_title'] : null }}"></dd>
                </dl>
            </dd>
            <dd>
                <dl class="dl-flex dl-multiple-cretate-multiple_article-body">
                    <dt class="dt-multiple-create-multiple_article-item">thumbnail url</dt>
                    <dd class="dd-multiple-create-multiple_article-value"><input type="text" name="article_image_thumbnail_url" value="{{ isset($values['article_image_thumbnail_url']) ? $values['article_image_thumbnail_url'] : null }}"></dd>
                </dl>
            </dd>
            <dd>
                <dl class="dl-flex dl-multiple-cretate-multiple_article-body">
                    <dt class="dt-multiple-create-multiple_article-item">header url</dt>
                    <dd class="dd-multiple-create-multiple_article-value"><input type="text" name="article_image_header_url" value="{{ isset($values['article_image_header_url']) ? $values['article_image_header_url'] : null }}"></dd>
                </dl>
            </dd>
            <dd>
                <dl class="dl-flex dl-multiple-cretate-multiple_article-body">
                    <dt class="dt-multiple-create-multiple_article-item">status</dt>
                    <dd class="dd-multiple-create-multiple_article-value">
                        <select name="article_status">
                            @foreach ($statuses as $status => $status_title)
                                <option value="{{ $status }}" @selected(isset($values["article_status"]) && $values["article_status"] == $status)>{{ $status_title }}</option>
                            @endforeach
                        </select>
                    </dd>
                </dl>
            </dd>
            <dd>
                <dl class="dl-flex dl-multiple-cretate-multiple_article-body">
                    <dt class="dt-multiple-create-multiple_article-item">valid_at</dt>
                    <dd class="dd-multiple-create-multiple_article-value"><input type="datetime-local" name="article_valid_at" value="{{ isset($values['article_valid_at']) ? $values['article_valid_at'] : null }}"></dd>
                </dl>
            </dd>
            <dd>
                <dl class="dl-flex dl-multiple-cretate-multiple_article-body">
                    <dt class="dt-multiple-create-multiple_article-item">expired_at</dt>
                    <dd class="dd-multiple-create-multiple_article-value"><input type="datetime-local" name="article_expired_at" value="{{ isset($values['article_expired_at']) ? $values['article_expired_at'] : null }}"></dd>
                </dl>
            </dd>
        </dl>
        <dl>
            <dt><h3>記事編集</h3></dt>
            <dd>
                <dl class="dl-flex dl-multiple-create-multiple_article-body">
                    <dt class="dt-multiple-create-multiple_article-item">本文</dt>
                    <dd class="dd-multiple-create-multiple_article-value"><textarea name="article_body">@isset($values["article_body"]){{ $values["article_body"] }}@endisset</textarea></dd>
                </dl>
            </dd>
            <dd>
                <dl class="dl-flex dl-multiple-create-multiple_article-body">
                    <dt class="dt-multiple-create-multiple_article-item"></dt>
                    <dd class="dd-multiple-create-multiple_article-value"><button type="submit" class="button button-create">保存</button></dd>
                </dl>
            </dd>
        </dl>
    </form>
</section>
<x-slot name="script">
</x-slot>
</x-website.frame.edit>
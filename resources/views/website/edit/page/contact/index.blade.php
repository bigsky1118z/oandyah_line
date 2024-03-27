<x-website.frame.edit>
<x-slot name="title">contact</x-slot>
<x-slot name="id">contact</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/edit/page">ページ</a> > 問い合わせページ</x-slot>
<section id="index">
    <h3>問い合わせページ 一覧</h3>
    <p><button type="button" onclick="location.href='/edit/page/contact/create'">新規作成</button></p>
    <dl id="dl-contact-index">
        <dt>
            <dl class="dl-contact-index-header">
                <dd class="dd-contact-index-page_path">パス</dd>
                <dd class="dd-contact-index-page_title">タイトル</dd>
                <dd class="dd-contact-index-button">操作</dd>
            </dl>
        </dt>
        @foreach ($pages as $page)
        <dd>
            <dl class="dl-contact-index-body">
                <dd class="dd-contact-index-page_path">{{ isset($page->path) ? $page->path : null }}</dd>
                <dd class="dd-contact-index-page_title">{{ isset($page->title) ? $page->title : null }}</dd>
                <dd class="dd-contact-index-button">
                    <dl class="dd-contact-index-button-values">
                        <dd><button type="button" onclick="location.href = '/edit/page/contact/{{ $page->id }}/post'">投稿</button></dd>
                        <dd><button type="button" onclick="location.href = '/edit/page/contact/{{ $page->id }}/edit'">編集</button></dd>
                        <dd><button type="button" onclick="location.href = '/edit/page/contact/{{ $page->id }}/delete'">削除</button></dd>
                    </dl>
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
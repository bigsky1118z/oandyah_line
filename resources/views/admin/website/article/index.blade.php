<x-admin.website.frame.basic title="articles" heading="記事ページ編集">
<h3>記事ページ一覧</h3>
<ul>
    @foreach ($articles as $article)
        <li><a href="/admin/website/article/{{ $article->name }}">{{ $article->title }}</a></li>
    @endforeach
</ul>
</x-admin.website.frame.basic>
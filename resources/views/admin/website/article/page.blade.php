<x-admin.website.frame.basic title="articles" heading="{{ $page_name }}記事一覧">
<p><button type="button" onclick="window.location.href = '/admin/website/article/{{ $page_name }}/create';">create</button></p>
<table>
    <thead>
        <tr>
            <th>title</th>
            <th rowspan="2" width="480px">body</th>
            <th>public</th>
            <th rowspan="2">action</th>
        </tr>
        <tr>
            <th>name</th>
            <th>datetime</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            <td>{{ $article->title }}</td>
            <td rowspan="2">{{ mb_strimwidth( preg_replace('/<(.*?)>(.*?)<\/(.*?)>/', '$2', $article['body']), 0, 150, '…', 'UTF-8' ) }}</td>
            <td>
                @if ($article->public_setting==0)
                    非公開                                
                @elseif($article->public_setting==1)
                    @if($article->public_datetime > date("Y-m-d H:i:s"))
                        公開予定
                    @elseif ($article->public_datetime <= date("Y-m-d H:i:s"))
                        公開
                    @endif
                @endif
            </td>
            <td><button type="button" onclick="window.location.href = '/admin/website/article/{{ $article->page->name }}/{{ $article->path }}';">preview</button></td>
        </tr>
        <tr>
            <td>{{ $article->path }}</td>
            <td><span style="font-size:10px;">({{ $article->public_datetime }})</span></td>
            <td><button type="button" onclick="window.location.href = '/admin/website/article/{{ $article->page->name }}/{{ $article->path }}/edit';">edit</button></td>
        </tr>
        @endforeach
    </tbody>
</table>
</x-admin.website.frame.basic>
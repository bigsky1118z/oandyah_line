<x-admin.website.frame.basic title="Contents" heading="コンテンツ一覧">
<p>
    <button type="button" onclick="window.location.href = '/admin/website/content/create';">create</button>
</p>
<table>
    <thead>
        <tr>
            <th>title</th>
            <th rowspan="2"  width="480px">body</th>
            <th>public</th>
            <th rowspan="2">action</th>
        </tr>
        <tr>
            <th>name</th>
            <th>datetime</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($contents as $content)
        <tr>
            <td>{{ $content->page->title }}</td>
            <td rowspan="2">{{ mb_strimwidth( preg_replace('/<(.*?)>(.*?)<\/(.*?)>/', '$2', $content['body']), 0, 150, '…', 'UTF-8' ) }}</td>
            <td>
                @if ($content->public_setting==0)
                    非公開                                
                @elseif($content->public_setting==1)
                    @if($content->public_datetime > date("Y-m-d H:i:s"))
                        公開予定
                    @elseif ($content->public_datetime <= date("Y-m-d H:i:s"))
                        公開
                    @endif
                @endif
            </td>
            <td><button type="button" onclick="window.location.href = '/admin/website/content/{{ $content->id }}';">preview</button></td>
        </tr>
        <tr>
            <td>{{ $content->page->name }}</td>
            <td><span style="font-size:10px;">({{ $content->public_datetime }})</span></td>
            <td><button type="button" onclick="window.location.href = '/admin/website/content/{{ $content->id }}/edit';">edit</button></td>
        </tr>
        @endforeach
    </tbody>
</table>
</x-admin.website.frame.basic>
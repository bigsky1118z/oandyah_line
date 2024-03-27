<x-admin.api.line.frame.basic title="リッチメニュー" heading="リッチメニュー" :channel="$channel">
<x-slot name="head">
</x-slot>
<p><a href="/api/line/{{ $channel->channel_name }}/richmenu/create">新規作成</a></p>
<table>
    <thead>
        <tr>
                <th>メニュー名</th>
                <th>横</th>
                <th>縦</th>
                <th>メニューバー表示テキスト</th>
                <th>領域数</th>
                {{-- <th>リッチメニューID</th> --}}
                <th>デフォルト</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @isset($richmenu_list)
                @foreach ($richmenu_list as $richmenu)
                    <tr>
                        <td>{{ isset($richmenu["name"]) ? $richmenu["name"] : null }}</td>
                        <td>{{ isset($richmenu["size"]["width"]) ? $richmenu["size"]["width"] . "px" : null }}</td>
                        <td>{{ isset($richmenu["size"]["height"]) ? $richmenu["size"]["height"] . "px" : null }}</td>
                        <td>{{ isset($richmenu["chatBarText"]) ? $richmenu["chatBarText"] : null }}</td>
                        <td>{{ isset($richmenu["areas"]) ? count($richmenu["areas"]) : null }}</td>
                        <td>@isset($richmenu["richMenuId"]) <a href="/api/line/{{ $channel->channel_name }}/richmenu/{{ $richmenu['richMenuId'] }}/default">{{ isset($default_richmenu_id) && $richmenu["richMenuId"] == $default_richmenu_id ? "解除" : "設定" }}</a>@endisset</td>
                        <td>{!! isset($richmenu["richMenuId"]) ? "<a href='/api/line/$channel->channel_name/richmenu/" . $richmenu["richMenuId"] . "'>詳細</a>" : null !!}</td>
                        <td>{!! isset($richmenu["richMenuId"]) ? "<a href='/api/line/$channel->channel_name/richmenu/" . $richmenu["richMenuId"] . "/delete'>削除</a>" : null !!}</td>
                    </tr>
                @endforeach
            @endisset
        </tbody>
    </table>
    
</x-admin.api.line.frame.basic>
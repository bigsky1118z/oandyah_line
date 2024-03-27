<x-admin.api.line.frame.basic title="メッセージ" heading="メッセージ" :channel="$channel">
<x-slot name="head">
</x-slot>
<ul>
    <li><a href="/api/line/{{ $channel->channel_name }}/message/create/text">テキスト</a></li>
    <li><a href="/api/line/{{ $channel->channel_name }}/message/create/image">画像</a></li>
    <li><a href="/api/line/{{ $channel->channel_name }}/message/create/location">位置情報</a></li>
    <li><a href="/api/line/{{ $channel->channel_name }}/message/create/template-buttons">選択ボタン</a></li>
    <li><a href="/api/line/{{ $channel->channel_name }}/message/create/template-confirm">確認ボタン</a></li>
</ul>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>カテゴリ</th>
            <th>メッセージ名</th>
            <th>タイプ</th>
            <th>ステータス</th>
            <th>内容</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($messages as $message)
            <tr>
                <td>{{ $message->id }}</td>
                <td>{{ $message->category }}</td>
                <td>{{ $message->name }}</td>
                {{-- <td>{{ strpos($message->name, 'autofill') == 0 ? "no name" : $message->name }}</td> --}}
                <td>{{ $message->type }}</td>
                <td>{{ $message->status }}</td>
                <td>{!! $message->get_preview() !!}</td>
                <td>@if($message->status == "未送信") <a href="/api/line/{{ $channel->channel_name }}/message/{{ $message->id }}/delete">削除</a> @endif</td>
            </tr>
        @endforeach
    </tbody>
</table>
</x-admin.api.line.frame.basic>
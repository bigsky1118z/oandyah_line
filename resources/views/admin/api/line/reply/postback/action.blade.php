<x-admin.api.line.frame.basic title="自動返信" :heading="$action_name" :channel="$channel">
<x-slot name="head">
<style>
    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }
</style>
</x-slot>
@foreach ($replies as $name => $grouped_replies)
<h3>{{ $name }}</h3>
    <table>
        <thead>
            <tr>
                <th>状態</th>
                <th>イベント名</th>
                <th>詳細</th>
                <th>補足</th>
                <th>値</th>
                <th>返信メッセージ</th>
                <th colspan="3">操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grouped_replies as $reply)
            <tr>
                <td>{{ $reply->active ? "有効" : null }}</td>
                <td>{{ $reply->name }}</td>
                <td>{{ $reply->detail }}</td>
                <td>{{ $reply->extra }}</td>
                <td>{{ $reply->value }}</td>
                <td>
                    <ul>
                        @foreach ($reply->get_line_api_messages() as $message)
                        <li>{{ $message->get_message_type() }}</li>
                        @endforeach
                    </ul>
                </td>
                <td><p><button onclick="location.href='/api/line/{{ $channel->channel_name }}/reply/postback/{{ $action }}/{{ $reply->id }}'">詳細</button></p></td>
                <td><p><button onclick="location.href='/api/line/{{ $channel->channel_name }}/reply/postback/{{ $action }}/{{ $reply->id }}/edit'">編集</button></p></td>
                <td><p><button onclick="location.href='/api/line/{{ $channel->channel_name }}/reply/postback/{{ $action }}/{{ $reply->id }}/delete'">削除</button></p></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endforeach

</x-admin.api.frame.basic>
<x-admin.api.line.frame.basic title="受信データ" heading="受信データ" :channel="$channel">
<x-slot name="head">
<style>
    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }
</style>
</x-slot>
<h3>受信データ詳細</h3>
<ul>
    <li><a href="/api/line/{{ $channel->channel_name }}/receive/event">event</a></li>
    <li><a href="/api/line/{{ $channel->channel_name }}/receive/message">message</a></li>
    <li><a href="/api/line/{{ $channel->channel_name }}/receive/postback">postback</a></li>
</ul>
<h3>受信ログ</h3>
<table>
    <thead>
        <tr>
            <th>ユーザーID</th>
            <th>名前</th>
            <th>タイプ</th>
            <th>返信状況</th>
            <th>受信日時</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($receives as $receive)
        <tr>
            <td>{{ $receive['line_user_id'] }}</td>
            <td>{{ $receive->user ? $receive->user->nickname() : null }}</td>
            <td>{{ $receive['type'] }}</td>
            <td>{{ $receive['response_status'] }}</td>
            <td>{{ $receive['created_at'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</x-admin.api.frame.basic>
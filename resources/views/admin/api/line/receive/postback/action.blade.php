<x-admin.api.line.frame.basic title="{{ $actions[$action] }} -受信データ" heading="{{ $actions[$action] }}" :channel="$channel">
<x-slot name="head">
</x-slot>
<h3>イベント名</h3>
<ul>
    @foreach ($names as $name)
        <li><a href="/api/line/{{ $channel->channel_name }}/receive/postback/{{ $action }}/{{ $name }}">{{ $name }}</a></li>
    @endforeach
</ul>
<h3>データログ</h3>
 <table>
    <thead>
        <tr>
            <th>受信日時</th>
            <th>名前</th>
            <th>イベント名</th>
            <th>詳細</th>
            <th>補足</th>
            <th>値</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($postbacks as $postback)
            @isset ($postback->postback)
            <tr>
                <td>{{ $postback->created_at }}</td>
                <td>{{ $postback->user->nickname() }}</td>
                <td>{{ $postback->get_data('name') }}</td>
                <td>{{ $postback->get_data('detail') }}</td>
                <td>{{ $postback->get_data('extra') }}</td>
                <td>{{ $postback->get_data('value') }}</td>
            </tr>
            @endisset
        @endforeach
    </tbody>
</table>

</x-admin.api.frame.basic>
<x-admin.api.line.frame.basic title="受信データ" heading="受信データ" :channel="$channel">
<x-slot name="head">
</x-slot>
<h3>機能</h3>
<ul>
    @foreach ($postback_actions as $key => $value)
        @if ($key != "default")
            <li><a href="/api/line/{{ $channel->channel_name }}/receive/postback/{{ $key }}">{{ $value }}</a></li>
        @endif    
    @endforeach
</ul>
<h3>データログ</h3>
 <table>
    <thead>
        <tr>
            <th>受信日時</th>
            <th>名前</th>
            <th>機能</th>
            <th>アクション</th>
            <th>ポストバック</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($postbacks as $postback)
            @isset ($postback->postback)
            <tr>
                <td>{{ $postback->created_at }}</td>
                <td>{{ $postback->user->nickname() }}</td>
                <td>{{ $postback->get_data('action') }}</td>
                <td>{{ $postback->get_data('value') }}</td>
                <td>{{ $postback->postback }}</td>
            </tr>
            @endisset
        @endforeach
    </tbody>
</table>
</x-admin.api.frame.basic>
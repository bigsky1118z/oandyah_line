<x-admin.api.line.frame.basic title="オーダー[postback 受信データ]" heading="オーダー[postback 受信データ]" :channel="$channel">
<x-slot name="head">
</x-slot>
<h3>機能</h3>
<h3>データログ</h3>
 <table>
    <thead>
        <tr>
            <th>受信日時</th>
            <th>名前</th>
            <th>商品</th>
            <th>値</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($postbacks as $postback)
            @isset ($postback->postback)
            <tr>
                <td>{{ $postback->created_at }}</td>
                <td>{{ $postback->user->nickname() }}</td>
                <td>{{ $postback->get_data('item') }}</td>
                <td>{{ $postback->get_data('value') }}</td>
                <td>{{ $postback->postback }}</td>
            </tr>
            @endisset
        @endforeach
    </tbody>
</table>
</x-admin.api.frame.basic>
<x-admin.api.line.frame.basic title="オーダー" heading="オーダー" :channel="$channel">
<x-slot name="head">
</x-slot>
<h3>オーダー機能一覧</h3>
<ul>
    <li><a href="/api/line/{{ $channel->channel_name }}/order/item">商品</a></li>    
    <li><a href="/api/line/{{ $channel->channel_name }}/order/menu">メニュー</a></li>    
</ul>
<h3>メニュー一覧</h3>
<ul>
    @foreach ($line_api_order_menus as $line_api_order_menu)
        <li><a href="/api/line/{{ $channel->channel_name }}/order/{{ $line_api_order_menu->name }}">{{ $line_api_order_menu->name }}</a></li>    
    @endforeach
</ul>
@isset($postbacks)
    <h3>POSTBACKログ</h3>
    @foreach ($postbacks as $postback)
        <dl class="dl-flex-left dl-dt-200px">
            <dt>{{ $postback->user->nickname() }}</dt>
            <dd>{{ $postback->created_at }}</dd>
            <dd>{{ $postback->postback }}</dd>
        </dl>
    @endforeach
@endisset
<x-slot name="script">
<script>
</script>
</x-slot>
</x-admin.api.frame.basic>
<x-admin.api.line.frame.basic title="{{ $group }}詳細 [オーダー]" heading="{{ $group }}詳細" :channel="$channel">
<x-slot name="head">
</x-slot>
<dl class="dl-flex-left">
    <dd><a href="/api/line/{{ $channel->channel_name }}/order/menu">商品一覧</a></dd>
    <dd><a href="/api/line/{{ $channel->channel_name }}/order/menu/{{ $group }}/edit">編集</a></dd>
    <dd><a href="/api/line/{{ $channel->channel_name }}/order/menu/{{ $group }}/delete">削除</a></dd>
</dl>
<dl class="dl-flex-left">
    <dt>ID</dt>
    <dt>カテゴリ</dt>
    <dt>サブカテゴリ</dt>
    <dt>メニュー記載名</dt>
    <dt>商品ID</dt>
    <dt>商品登録名</dt>
    <dt>値段</dt>
    <dt>商品説明</dt>
    <dt>ステータス</dt>
</dl>
@foreach ($menus as $menu)
    <dl class="dl-flex-left dl-dt-120px">
        <dd>{{ $menu->id }}</dd>
        <dd>{{ $menu->category }}</dd>
        <dd>{{ $menu->sub_category }}</dd>
        <dd>{{ $menu->display_name }}</dd>
        <dd>{{ $menu->line_api_order_item_id }}</dd>
        <dd>{{ $menu->line_api_order_item ? $menu->line_api_order_item->name : null }}</dd>
        <dd>{{ $menu->price }}</dd>
        <dd>{{ $menu->discription }}</dd>
        <dd>{{ $menu->status }}</dd>
        <dd><a href="/api/line/{{ $channel->channel_name }}/order/menu/{{ $group }}/item/{{ $menu->id }}/edit">編集</a></dd>
        <dd><a href="/api/line/{{ $channel->channel_name }}/order/menu/{{ $group }}/item/{{ $menu->id }}/delete">削除</a></dd>
    </dl>
@endforeach
<x-slot name="script">
</x-slot>
</x-admin.api.frame.basic>
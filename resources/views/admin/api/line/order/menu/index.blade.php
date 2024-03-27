<x-admin.api.line.frame.basic title="メニュー一覧 [オーダー]" heading="メニュー一覧 [オーダー]" :channel="$channel">
    <x-slot name="head">
    </x-slot>
    <dl>
        <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/menu/create'">新規メニュー作成</button></dd>
    </dl>
    <dl class="dl-flex-left">
        <dt>メニュー名</dt>
        <dt>掲載数</dt>
        <dt>詳細</dt>
        <dt>編集</dt>
    </dl>
    @foreach ($grouped_menus as $group => $menus)
    <dl class="dl-flex-left">
        <dd>{{ $group }}</dd>
        <dd>{{ count($menus) }}({{ count($menus->whereNotIn("status",array("非掲載"))) }})件</dd>
        <dd><a href="/api/line/{{ $channel->channel_name }}/order/menu/{{ $group }}/edit">メニュー設定</a></dd>
        <dd><a href="/api/line/{{ $channel->channel_name }}/order/menu/{{ $group }}/item">メニュー詳細設定</a></dd>
    </dl>
    @endforeach
    <x-slot name="script">
    </x-slot>
</x-admin.api.frame.basic>
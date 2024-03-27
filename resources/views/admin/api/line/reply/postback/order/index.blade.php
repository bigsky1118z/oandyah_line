<x-admin.api.line.frame.basic title="メニューごとの設定[自動返信]" heading="メニューごとの設定[自動返信]" :channel="$channel">
<x-slot name="head">
</x-slot>
<ul>
    @foreach ($menus as $menu)
        <li><a href="/api/line/{{ $channel->channel_name }}/reply/postback/order/{{ $menu->id }}">{{ $menu->name }}</a></li>
    @endforeach
</ul>
<x-slot name="hidden">
</x-slot>
<x-slot name="modal">
</x-slot>
<x-slot name="script">
</x-slot>
</x-admin.api.frame.basic>
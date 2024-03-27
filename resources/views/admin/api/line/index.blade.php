<x-admin.api.line.frame.basic title="チャンネル一覧" heading="チャンネル一覧">
<x-slot name="head">
</x-slot>
<dl>
    <dt></dt>
    <dd><button onclick="location.href='/api/line/create'">チャンネル新規登録</button></dd>
</dl>
@foreach ($channels as $channel)
    <dl class="dl-flex-left">
        <dt>{{ $channel->display_name }}</dt>
        <dd>[{{ $channel->channel_name }}]</dd>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}'">移動</button></dd>
    </dl>
@endforeach
</x-admin.api.line.frame.basic>
<x-admin.api.line.frame.basic title="自動返信作成" heading="自動返信作成" :channel="$channel">
<x-slot name="head">
</x-slot>
<form action="/api/line/{{ $channel->channel_name }}/reply/postback/create" method="post">
    <button type="submit">登録</button>
</form>
<x-slot name="hidden">
</x-slot>
<x-slot name="modal">
</x-slot>
<x-slot name="script">
</x-slot>
</x-admin.api.frame.basic>
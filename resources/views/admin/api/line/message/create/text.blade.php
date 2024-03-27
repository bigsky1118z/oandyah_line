@php
    $values =   array();
    if(!is_null(old())){
        $values =   old();
    }
@endphp
<x-admin.api.line.frame.basic title="テキストメッセージ" heading="テキストメッセージ">
<x-slot name="head">
</x-slot>
<form action="/api/line/{{ $channel->channel_name }}/message" method="post">
{{-- <form> --}}
    @csrf
    <x-admin.api.line.form.message.common />
    <x-admin.api.line.form.message.text />
    <dl class="dl-flex-left dl-dt-120px">
        <dt></dt>
        <dd><button type="submit">メッセージ登録</button></dd>
    </dl>
</form>
<x-slot name="hidden">
</x-slot>
<x-slot name="script">
</x-slot>
</x-admin.api.frame.basic>
@php
    $value =   null;
    if(isset($group) && !is_null($group)){
        $value =   $group;
    }
@endphp
<x-admin.api.line.frame.basic title="メニュー作成 [オーダー]" heading="メニュー作成" :channel="$channel">
<x-slot name="head">
</x-slot>
<dl>
    <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/menu'">メニュー一覧へ戻る</button></dd>
</dl>
<form action="/api/line/{{ $channel->channel_name }}/order/menu{{ !is_null($value) ? "/" . $value : null }}" method="post">
    @csrf
    <dl class="dl-flex-left dl-dt-120px">
        <dt>メニュー名</dt>
        <dd><input type="text" name="group" @if(!is_null($value)) value="{{ $value }}" @endif required></dd>
        <dd><button type="submit">メニュー登録</button></dd>
    </dl>
</form>
@if (!is_null($value))
    <dl>
        <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/menu/{{ $value }}/delete'">メニュー削除</button></dd>
    </dl>    
@endif
<x-slot name="script">
</x-slot>
</x-admin.api.frame.basic>
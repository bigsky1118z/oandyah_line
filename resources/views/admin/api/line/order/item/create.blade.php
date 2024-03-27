@php
    $values =   array();
    if(isset($item)){
        $values =   $item;
    }
    if(!is_null(old())){
        $values =   old();
    }
@endphp
<x-admin.api.line.frame.basic title="商品作成 [オーダー]" heading="商品作成" :channel="$channel">
<x-slot name="head">
</x-slot>
<form action="/api/line/{{ $channel->channel_name }}/order/item{{ isset($values["id"]) ? "/" . $values['id'] : null }}" method="post">
    @csrf
    <x-admin.api.line.form.order.item :values="$values" :categories="$categories" :subcategories="$sub_categories" />
    <dl class="dl-flex-left dl-dt-120px">
        <dt></dt>
        <dd><button type="submit">商品登録</button></dd>
        <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/item'">商品一覧へ戻る</button></dd>
    </dl>
</form>
<x-slot name="script">
</x-slot>
</x-admin.api.frame.basic>
<x-admin.api.line.frame.basic title="{{ $name }} お客様一覧 [オーダー]" heading="{{ $name }} お客様一覧" :channel="$channel">
<x-slot name="head">
</x-slot>
<dl class="dl-flex-left dl-dt-120px">
    <dd id="date"></dd>
    <dd><button type="button" onclick="location.reload();">更新</button></dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}'">{{ $name }} - TOP</button></dd>
    <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}/user'">お客様一覧</button></dd>
    <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}/all'">データ分析</button></dd>
</dl>
@if($grouped_orders->isNotEmpty())
    <dl class="dl-flex-left">
        <dt>名前</dt>
        <dt>テーブル</dt>
        <dt>数量</dt>
        <dt>金額</dt>
        <dt>ボタン</dt>
    </dl>
    @foreach ($grouped_orders as $line_api_user_id => $orders)
        <dl class="dl-flex-left">
            <dd>{{ $orders[0]->line_api_user ? $orders[0]->line_api_user->nickname() : null }}</dd>
            <dd>---</dd>
            <dd>{{ $orders->whereIn("status",array("未提供","提供済"))->sum("quantity") }}点</dd>
            <dd>{{ $orders->whereIn("status",array("未提供","提供済"))->sum(fn ($order) => $order->price * $order->quantity) }}円</dd>
            <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}/user/{{ $line_api_user_id }}'">会計</button></dd>
        </dl>
    @endforeach
@elseif($grouped_orders->isEmpty())
    <dl>
        <dd>ご注文のあるお客様はいません</dd>
    </dl>
@endif
<x-slot name="script">
<script>
    function setDate (){
        const date      =   new Date();
        const month     =   String(date.getMonth() + 1).padStart(2, '0');
        const day       =   String(date.getDate()).padStart(2, '0');
        const hours     =   String(date.getHours()).padStart(2, '0');
        const minutes   =   String(date.getMinutes()).padStart(2, '0');
        const seconds   =   String(date.getSeconds()).padStart(2, '0');
        document.getElementById("date").textContent =   `${month}月${day}日 ${hours}時${minutes}分${seconds}秒`;
    }
    setDate();
</script>
</x-slot>
</x-admin.api.frame.basic>
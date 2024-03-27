<x-admin.api.line.frame.basic title="{{ $name }}[オーダー]" heading="{{ $name }}" id="order-order" :channel="$channel">
<x-slot name="head">
</x-slot>
<dl class="dl-flex-left">
    <dd id="date"></dd>
    <dd><button type="button" onclick="location.reload();">更新</button></dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}'">{{ $name }} - TOP</button></dd>
    <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}/user'">お客様一覧</button></dd>
    <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}/all'">データ分析</button></dd>
</dl>
@foreach ($grouped_orders as $group => $orders)
    <section>
        <h3>{{ $group }}</h3>
        @if ($orders->isNotEmpty())
            <dl class="dl-flex-left">
                <dt>時間</dt>
                <dt>テーブル</dt>
                <dt>名前</dt>
                <dt>商品</dt>
                <dt>値段</dt>
                <dt>ボタン</dt>
            </dl>
            @foreach ($orders as $order)
                <dl class="dl-flex-left">
                    <dd>{{ explode(" ",$order->created_at)[1] }}</dd>
                    <dd>{{ $order->line_api_user ? $order->get_line_api_order_user("table") : "---" }}</dd>
                    <dd>{{ $order->line_api_user ? $order->get_line_api_order_user("rank") : "---" }}</dd>
                    <dd>{{ $order->line_api_user ? $order->get_line_api_order_user("point") : "---" }}</dd>
                    <dd>{{ $order->line_api_user ? $order->line_api_user->nickname() : "---" }}</dd>
                    <dd>{{ $order->line_api_order_menu_item ? $order->line_api_order_menu_item->display_name() : "---" }}</dd>
                    <dd style="text-align: right">{{ $order->price }}円</dd>
                    <dd style="text-align: right">{{ $order->quantity }}個</dd>
                    <dd style="text-align: right">{{ $order->price * $order->quantity }}円</dd>
                    <dd>
                        @switch($group)
                            @case("未提供")
                                <button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}/status/{{ $order->id }}/delivered'">提供済</button>
                                <button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}/status/{{ $order->id }}/cancel'">キャンセル</button>
                                @break
                            @case("提供済")
                                <button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}/status/{{ $order->id }}/ordered'">未提供</button>
                                <button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}/status/{{ $order->id }}/cancel'">キャンセル</button>
                                @break
                            @case("キャンセル")
                                <button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}/status/{{ $order->id }}/delivered'">提供済</button>
                                <button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}/status/{{ $order->id }}/ordered'">未提供</button>
                            @default
                                @break
                        @endswitch
                    </dd>
                </dl>
            @endforeach
        @elseif($orders->isEmpty())
            <p>{{ $group }}の商品はありません。</p>
        @endif
    </section>
@endforeach
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
    function updateStatus(button,type){

    }

    setTimeout(()=>location.reload(), 60000);

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
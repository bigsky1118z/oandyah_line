<x-admin.api.line.frame.basic title="{{ $name }} {{ $line_api_user->nickname() }}[オーダー]" heading="{{ $name }} {{ $line_api_user->nickname() }}" :channel="$channel">
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
@foreach ($grouped_orders as $status => $orders)
    <section>

        <h3>{{ $status }}</h3>
        @if ($orders->isNotEmpty())
            <dl class="dl-flex-left">
                <dt>時間</dt>
                <dt>商品</dt>
                <dt>数量</dt>
                <dt>単価</dt>
                <dt>金額</dt>
                <dt>ボタン</dt>
            </dl>
            @foreach ($orders as $order)
                <dl class="dl-flex-left">
                    <dd>{{ explode(" ",$order->created_at)[1] }}</dd>
                    <dd>{{ $order->line_api_order_menu_item ? $order->line_api_order_menu_item->display_name() : "---" }}</dd>
                    <dd style="text-align: right">{{ $order->price }}円</dd>
                    <dd style="text-align: right">{{ $order->quantity }}個</dd>
                    <dd style="text-align: right">{{ $order->price * $order->quantity }}円</dd>
                    <dd>
                        @switch($status)
                            @case("ご注文")
                                <span>{{ $order->status }}</span>
                                <button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}/status/{{ $order->id }}/cancel'">キャンセル</button>
                                @break
                            @case("キャンセル")
                                <button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}/status/{{ $order->id }}/delivered'">提供済</button>
                                <span>{{ $order->status }}</span>
                                @break
                        @endswitch

                    </dd>
                </dl>
            @endforeach
            @if ($status == "ご注文")
            </section>
            <section>
                <dd>{{ $orders[0]->line_api_user ? $orders[0]->line_api_user->nickname() : null }}</dd>
                
                <dl class="dl-flex-left dl-dt-120px dl-dd-120px dl-dd-right">
                    <dt>注文数</dt>
                    <dd>{{ $orders->sum("quantity") }}点</dd>
                </dl>
                <dl class="dl-flex-left dl-dt-120px dl-dd-120px dl-dd-right">
                    <dt>合計</dt>
                    <dd>{{ $orders->sum(fn ($order) => $order->price * $order->quantity) }}円</dd>
                </dl>
                <dl class="dl-flex-left dl-dt-120px dl-dd-120px dl-dd-right">
                    <dt>お預かり</dt>
                    <dd><input type="number" min="0" max="100000" oninput="caluculateChange(this);" style="text-align: right">円</dd>
                </dl>
                <dl class="dl-flex-left dl-dt-120px dl-dd-120px dl-dd-right">
                    <dt>お釣り</dt>
                    <dd id="change">--円</dd>
                </dl>
                <dl class="dl-flex-left dl-dt-120px dl-dd-120px dl-dd-right">
                    <dt></dt>
                    <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}/status/{{ $line_api_user->id }}/paid'">会計完了</button></dd>
                </dl>
            </section>
            @endif
        @elseif($orders->isEmpty())
        <dl>
            <dd>{{ $status }}の商品はありません</dd>
        </dl>
        @endif
    </section>
@endforeach
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

    function caluculateChange(input) {
        let change  =   null;
        if(input.value){
            const total     =   Number({{ $grouped_orders["ご注文"]->sum(fn ($order) => $order->price * $order->quantity) }});
            const deposit   =   Number(input.value);
            change  =   deposit-total;
        } else {
            change  =   "---";
        }
        document.getElementById("change").textContent   =   change + "円";
    }
</script>
</x-slot>
</x-admin.api.frame.basic>
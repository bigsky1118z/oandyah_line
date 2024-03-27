@php
    $major_count  =   0;
    $major_total  =   0;
@endphp

<x-admin.api.line.frame.basic title="{{ $name }} 会計済[オーダー]" heading="{{ $name }} 会計済" :channel="$channel">
<x-slot name="head">
</x-slot>
<dl class="dl-flex-left dl-dt-120px">
    <dd id="date"></dd>
    <dd><button type="button" onclick="location.reload();">更新</button></dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}'">{{ $name }} - TOP</button></dd>
    <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}/user'">お客様一覧</button></dd>
    <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}/paid'">支払済み一覧</button></dd>
    <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/{{ $name }}/all'">データ分析</button></dd>
</dl>
@foreach ($grouped_orders as $status => $orders)
@php
    $minor_count  =   0;
    $minor_total  =   0;
@endphp
    @if (!$orders->isEmpty())    
        <h3>{{ $status }}</h3>
        <table>
            <thead>
                <tr>
                    <th>時間</th>
                    <th>注文</th>
                    {{-- <th>名前</th>
                    <th>商品</th> --}}
                    <th>値段</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ explode(" ",$order->created_at)[1] }}</td>
                        <td>
                            <ul>
                                <li>[{{ $order->get_line_api_user() && $order->get_line_api_user()->line_api_user_table ? $order->get_line_api_user()->line_api_user_table->table : "-" }}] {{ $order->get_line_api_user() ? $order->get_line_api_user()->nickname() : null }}</li>
                                <li>{{ $order->get_line_api_order_menu() ? $order->get_line_api_order_menu()->item_name() : null }}</li>
                            </ul>
                        </td>
                            {{-- <td>{{ $order->get_line_api_user() ? $order->get_line_api_user()->nickname() : null }}</td>
                        <td>{{ $order->get_line_api_order_menu() ? $order->get_line_api_order_menu()->item_name() : null }}</td> --}}
                        <td style="text-align: right">{{ $order->price }}円</td>
                        @if ($order->price != 0)
                            @php $major_count ++; @endphp
                            @php $major_total += $order->price; @endphp
                            @php $minor_count ++; @endphp
                            @php $minor_total += $order->price; @endphp
                        @endif
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td style="text-align: right">{{ $minor_count }}点</td>
                    <td style="text-align: right">{{ $minor_total }}円</td>
                </tr>
            </tfoot>
        </table>
    @endif
@endforeach
<dl class="dl-flex-left">
    <dt>総計</dt>
    <dd>{{ $major_count }}点</dd>
    <dd>{{ $major_total }}円</dd>
</dl>
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
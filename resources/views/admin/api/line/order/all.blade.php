<x-admin.api.line.frame.basic title="{{ $name }} データ分析[オーダー]" heading="{{ $name }} データ分析" :channel="$channel">
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
<section>
    <form action="/api/line/{{ $channel->channel_name }}/order/{{ $name }}/all" method="post">
        @csrf
        <dl>
            <dt>絞り込み</dt>
            {{-- 日時の絞り込み --}}
            <dd>
                <dl class="dl-flex-left">   
                    <dt>日時</dt>
                    <dd>
                        <input name="from[date]" type="date" @isset($from["date"]) value="{{ $from["date"] }}" @endisset>
                        <select name="from[time]">
                            <option value="">---</option>
                            @foreach (range(0,23) as $number)
                                <option value="{{ $number }}" @if(isset($from["time"]) && $from["time"] == $number)  selected @endif>{{ $number }}時</option>
                            @endforeach
                        </select>
                    </dd>
                    <dd>～</dd>
                    <dd>
                        <input name="to[date]" type="date" @isset($to["date"]) value="{{ $to["date"] }}" @endisset>
                        <select name="to[time]">
                            <option value="">---</option>
                            @foreach (range(0,23) as $number)
                                <option value="{{ $number }}" @if(isset($to["time"]) && $to["time"] == $number)  selected @endif>{{ $number }}時</option>
                            @endforeach
                        </select>
                    </dd>
                </dl>
            </dd>
            {{-- ステータスの絞り込み --}}
            <dd>
                <dl class="dl-flex-left">
                    <dt>ステータス</dt>
                    <dd>
                        <label for="input-checkbox-delivered"><input type="checkbox" id="input-checkbox-delivered" name="status[delivered]" value="delivered" @if(!empty($status) && !isset($status["delivered"])) @else checked @endif>提供済</label>
                        <label for="input-checkbox-ordered"><input type="checkbox" id="input-checkbox-ordered" name="status[ordered]" value="ordered" @if(!empty($status) && !isset($status["ordered"])) @else checked @endif>未提供</label>
                        <label for="input-checkbox-cancel"><input type="checkbox" id="input-checkbox-cancel" name="status[cancel]" value="cancel" @if(!empty($status) && !isset($status["cancel"])) @else checked @endif>キャンセル</label>
                        <label for="input-checkbox-paid"><input type="checkbox" id="input-checkbox-paid" name="status[paid]" value="paid" @if(!empty($status) && !isset($status["paid"])) @else checked @endif>会計済</label>
                    </dd>
                </dl>
            </dd>
            {{-- 並び替え --}}
            <dd>
                <dl class="dl-flex-left">
                    <dt>モード</dt>
                    <dd>
                        <select name="groupBy">
                            <option value="" @if(!isset($groupBy)) selected @endif>一覧</option>
                            <option value="line_api_user_id" @if(isset($groupBy) && $groupBy == "line_api_user_id") selected @endif>名前</option>
                            <option value="line_api_order_menu_item_id" @if(isset($groupBy) && $groupBy == "line_api_order_menu_item_id") selected @endif>商品</option>
                            <option value="status" @if(isset($groupBy) && $groupBy == "status") selected @endif>ステータス</option>
                        </select>
                    </dd>
                </dl>
            </dd>
            {{-- 実行ボタン --}}
            <dd>
                <input type="submit" value="絞り込み">
            </dd>
        </dl>
    </form>
</section>
<section>
    {{-- H3タグ --}}
    @switch($groupBy)
        @case("line_api_user_id")
            <h3>名前別一覧</h3>
            @break
        @case("line_api_order_menu_item_id")
            <h3>商品別一覧</h3>
            @break
        @case("status")
            <h3>ステータス別一覧</h3>
            @break
        @default
            <h3>データ一覧</h3>
            @break
    @endswitch
    @if ($orders->isNotEmpty())
        {{-- 絞り込みデータ全体の合計総額 --}}
        <dl class="dl-flex-left" style="font-weight:bolder">
            <dt>該当データ</dt>
            <dd>{{ count($orders->flatten()) }}件</dd>
            <dt>合計</dt>
            <dd>{{ $orders->flatten()->sum("quantity") }}点</dd>
            <dt>総額</dt>
            <dd>{{ $orders->flatten()->sum(fn ($order) => $order->price * $order->quantity) }}円</dd>
        </dl>
        {{-- モード=一覧 --}}
        @if (!isset($groupBy) || is_null($groupBy))
            {{-- データヘッダー --}}
            <dl class="dl-flex-left">
                <dt>時間</dt>
                <dt>名前</dt>
                <dt>商品</dt>
                <dt>単価</dt>
                <dt>数量</dt>
                <dt>金額</dt>
                <dt>ステータス</dt>
            </dl>
            {{-- データボディ --}}
            @foreach ($orders as $order)
                <dl class="dl-flex-left">
                    <dd>{{ explode(" ",$order->created_at)[1] }}</dd>
                    <dd>{{ $order->line_api_user ? $order->line_api_user->nickname() : null }}</dd>
                    <dd>{{ $order->line_api_order_menu_item ? $order->line_api_order_menu_item->display_name() : null }}</dd>
                    <dd style="text-align: right">{{ $order->price }}円</dd>
                    <dd style="text-align: right">{{ $order->quantity }}円</dd>
                    <dd style="text-align: right">{{ $order->price * $order->quantity }}円</dd>
                    <dd>{{ $order->status }}</dd>
                </dl>
            @endforeach
        {{-- モード=一覧以外 --}}
        @elseif (isset($groupBy))
            @foreach ($orders as $group => $part_of_orders)
                {{-- 個別データ --}}
                <dl class="dl-flex-left" style="font-weight: bold">
                    @switch($groupBy)
                        @case ("line_api_user_id")
                            <dt>{{ $part_of_orders[0]->line_api_user ? $part_of_orders[0]->line_api_user->nickname() : null }}</dt>
                            @break
                        @case ("line_api_order_menu_item_id")
                            <dt>{{ $part_of_orders[0]->line_api_order_menu_item ? $part_of_orders[0]->line_api_order_menu_item->display_name() : null }}</dt>
                            @break
                        @case ("status")
                            <dt>{{ $group }}</dt>
                            @break                        
                    @endswitch
                        <dt>合計</dt>
                    <dd>{{ $part_of_orders->sum("quantity") }}点</dd>
                    <dt>総額</dt>
                    <dd>{{ $part_of_orders->sum(fn ($order) => $order->price * $order->quantity) }}円</dd>
                </dl>
                {{-- データヘッダー --}}
                <dl class="dl-flex-left">
                    <dt>時間</dt>
                    <dt>名前</dt>
                    <dt>商品</dt>
                    <dt>単価</dt>
                    <dt>数量</dt>
                    <dt>金額</dt>
                    <dt>ステータス</dt>
                </dl>
                {{-- データボディ --}}
                @foreach ($part_of_orders as $order)
                    <dl class="dl-flex-left">
                        <dd>{{ explode(" ",$order->created_at)[1] }}</dd>
                        <dd>{{ $order->line_api_user ? $order->line_api_user->nickname() : null }}</dd>
                        <dd>{{ $order->line_api_order_menu_item ? $order->line_api_order_menu_item->display_name() : null }}</dd>
                        <dd style="text-align: right">{{ $order->price }}円</dd>
                        <dd style="text-align: right">{{ $order->quantity }}円</dd>
                        <dd style="text-align: right">{{ $order->price * $order->quantity }}円</dd>
                        <dd>{{ $order->status }}</dd>
                    </dl>
                @endforeach
            @endforeach
        @endif
    {{-- データがない場合 --}}
    @elseif($orders->isEmpty())
        <dl class="dl-flex-left" style="font-weight:bolder">
            <dt>該当データ</dt>
            <dd>{{ count($orders->flatten()) }}件</dd>
        </dl>
    @endif
</section>
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
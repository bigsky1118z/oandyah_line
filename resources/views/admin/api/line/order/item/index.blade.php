<x-admin.api.line.frame.basic title="商品一覧 [オーダー]" heading="商品一覧 [オーダー]" id="order-item" :channel="$channel">
    <x-slot name="head">
    </x-slot>
    <dl>
        <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/item/create'">新規商品作成</button></dd>
    </dl>
    <dl class="dl-flex-left">
        <dt class="item-code">コード</dt>
        <dt class="item-name">名前</dt>
        <dt class="item-size">サイズ</dt>
        <dt class="item-category">カテゴリ</dt>
        <dt class="item-sub_category">サブカテゴリ</dt>
        <dt class="item-material">材料</dt>
        <dt class="item-allergy">アレルギー</dt>
        <dt class="item-buttons">ボタン</dt>
    </dl>
    @foreach ($items as $item)
    <dl class="dl-flex-left">
        <dd class="item-code">{{ $item->code }}</dd>
        <dd class="item-name">{{ $item->name }}</dd>
        <dd class="item-size">{{ $item->size }}</dd>
        <dd class="item-category">{{ $item->category }}</dd>
        <dd class="item-sub_category">{{ $item->sub_category }}</dd>
        <dd class="item-material">
            @isset($item->material)
            <ul>
                @foreach ($item->material as $material)
                    @isset($material["material"])
                        <li>{{ $material["material"] }}{{ isset($material["quantity"]) ? $material['quantity'] : null }}</li>
                    @endisset
                @endforeach
            </ul>
            @endisset
        </dd>
        <dd class="item-allergy">
            @isset($item->allergy)
            <ul>
                @foreach ($item->allergy as $allergy)
                    <li>{{ $allergy}}</li>
                @endforeach
            </ul>
            @endisset
        </dd>
        <dd class="item-button">@if($item->channel_name != "all")<a href="/api/line/{{ $channel->channel_name }}/order/item/{{ $item->id }}">詳細</a>@endif</dd>
        <dd class="item-button">@if($item->channel_name != "all")<a href="/api/line/{{ $channel->channel_name }}/order/item/{{ $item->id }}/edit">編集</a>@endif</dd>
        <dd  class="item-button">@if($item->channel_name != "all")<a href="/api/line/{{ $channel->channel_name }}/order/item/{{ $item->id }}/delete">削除</a>@endif</dd>
    </dl>
    @endforeach
    <x-slot name="script">
    </x-slot>
</x-admin.api.frame.basic>
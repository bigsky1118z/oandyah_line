<x-admin.api.line.frame.basic title="商品詳細 [オーダー]" heading="商品詳細 [オーダー]" :channel="$channel">
<x-slot name="head">
</x-slot>
<dl class="dl-flex-left">
    <dd><a href="/api/line/{{ $channel->channel_name }}/order/item">商品一覧</a></dd>
    <dd><a href="/api/line/{{ $channel->channel_name }}/order/item/{{ $item->id }}/edit">編集</a></dd>
    <dd><a href="/api/line/{{ $channel->channel_name }}/order/item/{{ $item->id }}/delete">削除</a></dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>ID</dt>
    <dd>{{ $item->id }}</dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>コード</dt>
    <dd>{{ $item->code }}</dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>商品名</dt>
    <dd>{{ $item->name }}</dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>カテゴリ</dt>
    <dd>{{ $item->category }}</dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>サブカテゴリ</dt>
    <dd>{{ $item->sub_category }}</dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>材料</dt>
    <dd>
        @if (isset($item->material) && count($item->material) > 0)
        <ul>
            @foreach ($item->material as $material)
                @isset($material["material"])
                    <li>{{ $material["material"] }}{{ isset($material["quantity"]) ? $material['quantity'] : null }}</li>
                @endisset
            @endforeach
        </ul>
        @else
            <span>登録なし</span>
        @endif
    </dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>アレルギー</dt>
    <dd>
        @if (isset($item->allergy) && count($item->allergy) > 0)
        <ul>
            @foreach ($item->allergy as $allergy)
                <li>{{ $allergy }}</li>
            @endforeach
        </ul>
        @else
            <span>登録なし</span>
        @endif
    </dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>画像(スクエア)</dt>
    <dd>
        @if (isset($item->square_image_url))
            <img src="{{ $item->square_image_url }}">
        @else
            <span>設定なし</span>
        @endif
    </dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>画像(ワイド)</dt>
    <dd>
        @if (isset($item->wide_image_url))
            <img src="{{ $item->square_image_url }}">
        @else
            <span>設定なし</span>
        @endif
    </dd>
</dl>
<x-slot name="script">
</x-slot>
</x-admin.api.frame.basic>
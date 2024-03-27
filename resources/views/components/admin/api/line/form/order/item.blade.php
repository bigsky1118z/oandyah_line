<dl class="dl-flex-left dl-dt-120px">
    <dt>コード</dt>
    <dd><input type="text" name="code" @if(isset($values["code"])) value="{{ $values["code"] }}" @endif required></dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>商品名</dt>
    <dd><input type="text" name="name" @if(isset($values["name"])) value="{{ $values["name"] }}" @endif required></dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>カテゴリ</dt>
    <dd>
        <input type="text" name="category" @if(isset($values["category"])) value="{{ $values["category"] }}" @endif list="datalist-order-item-category" autocomplete="off" required>
        <datalist id="datalist-order-item-category">
            @isset($categories)
                @foreach ($categories as $category)
                    <option value="{{ $category }}"></option>
                @endforeach
            @endisset
        </datalist>
    </dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>サブカテゴリ</dt>
    <dd>
        <input type="text" name="sub_category" @if(isset($values["sub_category"])) value="{{ $values["sub_category"] }}" @endif list="datalist-order-item-sub_category"  autocomplete="off">
        <datalist id="datalist-order-item-sub_category">
            @isset($subcategories)
                @foreach ($subcategories as $sub_category)
                    <option value="{{ $sub_category }}"></option>
                @endforeach
            @endisset
        </datalist>
    </dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>サイズ</dt>
    <dd><input type="text" name="size" @if(isset($values["size"])) value="{{ $values["size"] }}">@endif </dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>材料</dt>
    <dd style="display: flex; flex-wrap:nowrap; overflow-y: auto; max-width:70%">
        @foreach (range(0,19) as $number)
            <dl>
                <dt>素材{{ $number + 1 }}</dt>
                <dd><input type="text" name="material[{{ $number }}][material]" @if(isset($values["material"][$number]["material"])) value="{{ $values["material"][$number]["material"] }}" @endif placeholder="素材"></dd>
                <dd><input type="text" name="material[{{ $number }}][quantity]" @if(isset($values["material"][$number]["quantity"])) value="{{ $values["material"][$number]["quantity"] }}" @endif placeholder="分量"></dd>
            </dl>
        @endforeach
    </dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>アレルギー</dt>
    <dd style="display: flex; flex-wrap:wrap; max-width:70%">
        @foreach (App\Models\Api\LineApiOrderItem::$allergies as $allergy_index => $allergy)
            <label for="checkbox-order-item-{{ $allergy_index }}" style="width:160px;"><input type="checkbox" id="checkbox-order-item-{{ $allergy_index }}" name="allergy[]" value="{{ $allergy }}" @if(isset($values["allergy"]) && in_array($allergy,$values["allergy"]) ) checked  @endif>{{ $allergy }}</label>
        @endforeach
    </dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>画像(スクエア)</dt>
    <dd><button type="button">画像選択</button></dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>画像(ワイド)</dt>
    <dd><button type="button">画像選択</button></dd>
</dl>

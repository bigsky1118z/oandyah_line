@php
    $values =   array();
    if(isset($menu) && !is_null($menu)){
        $values =   $menu;
    }
    if(!is_null(old())){
        $values =   old();
    }
@endphp
<x-admin.api.line.frame.basic title="メニュー追加 {{ $group }} [オーダー]" heading="メニュー追加 {{ $group }}" :channel="$channel">
<x-slot name="head">
</x-slot>
<dl class="dl-flex-left">
    <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/menu'">メニュー一覧へ戻る</button></dd>
    <dd><button type="button" onclick="location.href='/api/line/{{ $channel->channel_name }}/order/menu/{{ $group }}/item'">{{ $group }}へ戻る</button></dd>
</dl>
<form action="/api/line/{{ $channel->channel_name }}/order/menu/{{ $group }}/item{{ isset($values['id']) ? "/" . $values['id'] : null }}" method="post">
    @csrf
    <dl class="dl-flex-left dl-dt-120px">
        <dt>商品選択</dt>
        <dd>
            <select name="line_api_order_item_id" onchange="getItemDetail(this);" required>
                <option value="">---</option>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}" @if(isset($values["line_api_order_item_id"]) && $values["line_api_order_item_id"] == $item->id) selected @endif>({{ $item->category }}){{ $item->name }}</option>
                @endforeach
            </select>
        </dd>
        <dd><button type="button" onclick="openModal('create-order-item');">商品作成</button></dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>オリジナル名</dt>
        <dd><input type="text" name="display_name" @isset($values["display_name"]) value="{{ $values["display_name"] }}" @endisset></dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>カテゴリ</dt>
        <dd><input type="text" name="category" @isset($values["category"]) value="{{ $values["category"] }}" @endisset required></dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>サブカテゴリ</dt>
        <dd><input type="text" name="sub_category" @isset($values["sub_category"]) value="{{ $values["sub_category"] }}" @endisset></dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>値段</dt>
        <dd><input type="number" name="price" @isset($values["price"]) value="{{ $values["price"] }}" @endisset required></dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>商品説明</dt>
        <dd><textarea name="discription" cols="30" rows="10">@isset($values["discription"]) {{ $values["discription"] }}@endisset</textarea></dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>ステータス</dt>
        <dd>
            <select name="status" required>
                <option value="在庫あり" @if(isset($values["status"]) && $values["status"] == "在庫あり") selected @endif>在庫あり</option>
                <option value="在庫なし" @if(isset($values["status"]) && $values["status"] == "在庫なし") selected @endif>在庫なし</option>
                <option value="販売終了" @if(isset($values["status"]) && $values["status"] == "販売終了") selected @endif>販売終了</option>
                <option value="非掲載" @if(isset($values["status"]) && $values["status"] == "非掲載") selected @endif>非掲載</option>
            </select>
        </dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt></dt>
        <dd><button type="submit">メニュー登録</button></dd>
    </dl>
</form>
<dl class="dl-flex-left dl-dt-120px">
    <dt>商品詳細</dt>
    <dd id="item-detail">
        <dl class="dl-flex-left dl-dt-150px">
            <dt>コード</dt>
            <dd id="item-detail-code"></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-150px">
            <dt>カテゴリ</dt>
            <dd id="item-detail-category"></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-150px">
            <dt>サブカテゴリ</dt>
            <dd id="item-detail-sub_category"></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-150px">
            <dt>名前</dt>
            <dd id="item-detail-name"></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-150px">
            <dt>サイズ</dt>
            <dd id="item-detail-size"></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-150px">
            <dt>材料</dt>
            <dd id="item-detail-material"></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-150px">
            <dt>アレルギー</dt>
            <dd id="item-detail-allergy"></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-150px">
            <dt>画像（スクエア）</dt>
            <dd id="item-detail-square_image_url"></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-150px">
            <dt>画像（ワイド）</dt>
            <dd id="item-detail-wide_image_url"></dd>
        </dl>
    </dd>
</dl>

<x-slot name="modal">
<div id="create-order-item" class="hidden" style="position: fixed; width:100%; height:100%; top:0; left:0; background-color:rgba(0,0,0,0.5); display:flex; justify-content:center;flex-direction:column;align-items:center;">
    <iframe src="/api/line/{{ $channel->channel_name }}/order/item/create-async" height="75%" width="90%" frameborder="1" loading="lazy" ></iframe>
    <p style="text-align: center;"><button type="button" onclick="cancelModal(this);">キャンセル</button></p>
</div>
</x-slot>
<x-slot name="script">
<script>
    function openModal(value){
        document.getElementById(value).classList.remove("hidden");
    }
    function cancelModal(button){
        const modal =   button.closest("div");
        modal.classList.add("hidden");
    }

    function getItemDetail(select){
        if(select.value){
            fetch(`/api/line/{{ $channel->channel_name }}/order/item/async/${select.value}`).then(response=>{
                return response.json();
            }).then(data=>{
                const details   =   ["code","category","sub_category","name","size","material","allergy","square_image_url","wide_image_url"];
                details.forEach(key=>{
                    const dd    =   document.getElementById("item-detail-" + key);
                    if(dd && data.hasOwnProperty(key)){
                        const value =   data[key];
                        if(value){
                            switch(key){
                                case "material":
                                    dd.textContent  =   value.map(material=>Object.values(material).join(" ")).join(",");
                                    break;
                                case "allergy":
                                    dd.textContent  =   value.join(",");
                                    break;
                                case "square_image_url":
                                case "wide_image_url":
                                    dd.innerHTML    =   `<img src="${value}" />`;
                                    break;
                                default:
                                    dd.textContent  =   value;
                                    break;
                            }
                        }
                    }
                });
            }).catch(error=>console.error(error));
        }
    }

    function reloadSelector(){
        fetch("/api/line/{{ $channel->channel_name }}/order/item/async/list").then(response=>{
            return response.json();
        }).then(data=>{
            const select    =   document.querySelector("select[name=line_api_order_item_id]");
            while(select.lastChild){
                select.removeChild(select.lastChild);
            }
            const defaultOption =   document.createElement("option");
            defaultOption.textContent   =   "---";
            select.appendChild(defaultOption);
            data.forEach((item,index)=>{
                const option    =   document.createElement("option");
                option.setAttribute("value",item.id);
                option.textContent  =   `(${item.category})${item.name}`;
                if(data.length == index+1){
                    option.selected =   true;
                }
                select.appendChild(option);
            });
            select.onchange();
        });
    }
</script>
</x-slot>
</x-admin.api.frame.basic>
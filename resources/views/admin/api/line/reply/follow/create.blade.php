@php
    $values =   array();
    if(isset($reply)){
        $values =   $reply;
    } elseif (!is_null(old())){
        $values =   old();
    }
@endphp
<x-admin.api.line.frame.basic title="新規作成 友達追加" heading="新規作成 友達追加" :channel="$channel">
<x-slot name="head">
</x-slot>
<section>
    <form action="/api/line/{{ $channel->channel_name }}/reply/follow{{ isset($values["id"]) ? '/' . $values["id"] : null }}" method="post">
        @csrf
        <dl class="dl-flex-left dl-dt-150px">
            <dt>名前</dt>
            <dd><input type="text" name="name" @if(isset($values["name"])) value="{{ $values["name"] }}" @endif></dd>
        </dl>
        <dl class="dl-flex-left dl-dt-150px">
            <dt>条件設定</dt>
            <dd>
                <select name="condition" required>
                    @if (isset($values["condition"]) && $values["condition"] == "default")
                        <option value="default">デフォルト</option>
                    @else
                        <option value="">---</option>
                        <option value="follow" @if(isset($values["condition"]) && $values["condition"] == "follow") selected @endif>新規フォロー</option>
                        <option value="refollow" @if(isset($values["condition"]) && $values["condition"] == "refollow") selected @endif>ブロック解除</option>
                    @endif
                </select>                    
            </dd>
        </dl>
        <dl class="dl-flex-left dl-dt-150px">
            <dt>通知</dt>
            <dd>
                <select name="notificationDisabled">
                    <option value="0" @if(isset($values["notification_disabled"]) && $values["notification_disabled"] == false) selected @endif>通知</option>
                    <option value="1" @if(isset($values["notification_disabled"]) && $values["notification_disabled"] == true) selected @endif>非通知</option>
                </select>
            </dd>
        </dl>
        <dl class="dl-flex-left dl-dt-150px">
            <dt>有効時限(開始)</dt>
            <dd>
                <input type="datetime-local" name="valid_at" @if(isset($values["valid_at"])) value="{{ $values["valid_at"] }}" @endif>
            </dd>
        </dl>
        <dl class="dl-flex-left dl-dt-150px">
            <dt>有効時限(終了)</dt>
            <dd>
                <input type="datetime-local" name="expired_at" @if(isset($values["expired_at"])) value="{{ $values["expired_at"] }}" @endif>
            </dd>
        </dl>
        @foreach (range(1,5) as $number)
        <dl class="dl-flex-left dl-dt-150px">
            <dt>メッセージ選択{{ $number }}</dt>
            <dd>
                <select id="message-{{ $number }}-category" class="message-object select-category" data-target="message-{{ $number }}-select" onchange="selectSearch(this);">
                    <option value="">---</option>
                    @php $category_array =   array(); @endphp
                    @foreach ($line_api_messages as $line_api_message)
                        @if(in_array(array($line_api_message->category, $line_api_message->sub_category), $category_array))
                            @continue
                        @else
                            @php $category_array[]  =   array($line_api_message->category, $line_api_message->sub_category); @endphp
                            <option value="{{ $line_api_message->category }}" data-category="{{ $line_api_message->category }}" data-sub-category="{{ $line_api_message->sub_category }}">{{ $line_api_message->category }} {{ isset($line_api_message->sub_category) ? "($line_api_message->sub_category)" : null }}</option>
                        @endif
                    @endforeach
                </select>
                <select id="message-{{ $number }}-select" class="message-object select-message" name="massages[]" @if ($loop->first) required @endif>
                    <option value="">---</option>
                    @foreach ($line_api_messages as $line_api_message)
                        <option value="{{ $line_api_message->id }}" data-category="{{ $line_api_message->category }}" data-sub-category="{{ $line_api_message->sub_category }}" @if(isset($values["line_api_message_" . $number . "_id"]) && $values["line_api_message_" . $number . "_id"] == $line_api_message->id) selected @endif>{{ $line_api_message->name }}</option>
                    @endforeach
                </select>
            </dd>
            <dd><button type="button">新規メッセージ作成</button></dd>
        </dl>
        @endforeach
        <dl class="dl-flex-left dl-dt-150px">
            <dt></dt>
            <dd><button type="submit">更新</button></dd>
        </dl>
    </form>
</section>
<x-slot name="script">
<script>
    function selectSearch(select){
        const target    =   document.getElementById(select.getAttribute("data-target"));
        if(target){
            const selected      =   select.options[select.selectedIndex];
            const category      =   selected.hasAttribute("data-category") ? selected.getAttribute("data-category") : "";
            const subCategory   =   selected.hasAttribute("data-sub-category") ? selected.getAttribute("data-sub-category") : "";
            if(category){
                Array.from(target.children).forEach(node => {
                    if(!node.value){
                        node.classList.remove("hidden");
                    } else if(category == node.getAttribute("data-category") && subCategory == node.getAttribute("data-sub-category")){
                        node.classList.remove("hidden");                        
                    } else {
                        node.classList.add("hidden");
                    }
                });
                const targetSelected    =   target.options[target.selectedIndex];
                const targetCategory    =   targetSelected.hasAttribute("data-category") ? targetSelected.getAttribute("data-category") : "";
                const targetSubCategory =   targetSelected.hasAttribute("data-sub-category") ? targetSelected.getAttribute("data-sub-category") : "";
                if(targetCategory != category || targetSubCategory != subCategory){
                    target.selectedIndex    =   0;
                }
            }else{
                Array.from(target.children).forEach(node => node.classList.remove("hidden"));
            }
        } else {
            console.error("対象が見つかりません");
        }
    }
</script>
</x-slot>
</x-admin.api.frame.basic>
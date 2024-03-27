<x-admin.api.line.frame.basic title="友達追加" heading="友達追加" :channel="$channel">
<x-slot name="head">
</x-slot>
<dl class="dl-flex-left dl-dt-120px">
    <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/reply/follow'">一覧</button></dd>
    <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/reply/follow/create'">新規</button></dd>
    <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/reply/follow/{{ $reply->id }}/edit'">編集</button></dd>
    <dd>@if($reply->condition!="default")<button onclick="window.confirm('削除しますか？') ? location.href='/api/line/{{ $channel->channel_name }}/reply/follow/{{ $reply->id }}/delete' : null;">削除</button>@endif</dd>
</dl>
<section>
    <h3>{{ $reply->name }}</h3>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>名前</dt>
        <dd>{{ $reply->name }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>条件設定</dt>
        <dd>{{ array("default"=>"デフォルト","follow"=>"新規フォロー","refollow"=>"ブロック解除")[$reply->condition]}}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>メッセージ通知</dt>
        <dd>{{ $reply->notification_disabled ? "非通知" : "通知" }}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>メッセージ1</dt>
        <dd>{!! $reply->line_api_message_1 ? $reply->line_api_message_1->get_preview() : "登録なし" !!}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>メッセージ2</dt>
        <dd>{!! $reply->line_api_message_2 ? $reply->line_api_message_2->get_preview() : "登録なし" !!}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>メッセージ3</dt>
        <dd>{!! $reply->line_api_message_3 ? $reply->line_api_message_3->get_preview() : "登録なし" !!}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>メッセージ4</dt>
        <dd>{!! $reply->line_api_message_4 ? $reply->line_api_message_4->get_preview() : "登録なし" !!}</dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>メッセージ5</dt>
        <dd>{!! $reply->line_api_message_5 ? $reply->line_api_message_5->get_preview() : "登録なし" !!}</dd>
    </dl>
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
@php
    $values =   array();
    if(!is_null(old())){
        $values =   old();
    }
@endphp
<x-admin.api.line.frame.async title="テキストメッセージ" heading="テキストメッセージ">
<x-slot name="head">
</x-slot>
<form>
    @csrf
    <h3>管理用</h3>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>カテゴリ</dt>
        <dd><input type="text" name="category" maxlength="100" required></dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>メッセージ名</dt>
        <dd><input type="text" name="name" maxlength="100" required></dd>
    </dl>
    <h3>メッセージ</h3>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>タイプ</dt>
        <dd>位置情報<input type="hidden" name="type" value="location"></dd>
    </dl>        
    <dl class="dl-flex-left dl-dt-120px">
        <dt>場所</dt>
        <dd><input type="text" name="title" required></dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>住所</dt>
        <dd><input type="text" name="address" oninput="console.log(this);" required></dd>
        <dd><input type="hidden" name="latitude" required></dd>
        <dd><input type="hidden" name="longitude" required></dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt></dt>
        <dd><button type="button" onclick="postForm(this);">メッセージ登録</button></dd>
    </dl>
</form>
<x-slot name="hidden">
</x-slot>
<x-slot name="script">
<script>
    function postForm(button) {
        let validate    =   true;
        const formData  =   new FormData(button.closest("form"));
        button.closest("form").querySelectorAll("input, textarea, select").forEach(node=> node.required && !node.value ? validate = false : null);
        if(validate){
            const options   =   {
                "method"    :   "post",
                "body"      :   formData,
            }
            fetch("/api/line/{{ $channel->channel_name }}/message/create/text", options).then(response=>{
                if(response.ok){
                    window.frameElement.closest("div").classList.add("hidden");
                    window.parent.reloadSelector();
                    location.reload();
                } else {
                    throw new Error(response.status);
                }
            }).catch(error=>console.error(error));
        }else{
            console.log("validation error");
        }
    }
</script>
</x-slot>
</x-admin.api.frame.async>
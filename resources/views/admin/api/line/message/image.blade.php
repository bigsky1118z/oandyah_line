@php
    $values =   array();
    if(!is_null(old())){
        $values =   old();
    }
@endphp
<x-admin.api.line.frame.async title="画像メッセージ" heading="画像メッセージ">
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
    {{-- // case("image"):
    //     $button_options =   array(
    //         "class"         =>  "unselect",
    //         "onclick"       =>  "imageSelectButton(this);",
    //         "textContent"   =>  "画像選択",
    //     );
    //     $input_options  =   array(
    //         "accept"    =>  "image/*",
    //         "onchange"  =>  "imageSelect(this);",
    //         "style"     =>  "display:none;",
    //         "required"  =>  true,
    //     );
    //     $data[] =   array(
    //         $get_form("originalContentUrl", "input", "text", $input_options, "メイン画像"),
    //         $get_form(null, "button", "button", $button_options),
    //     );
    //     $input_options["required"]    =   false;
    //     $data[] =   array(
    //         $get_form("previewImageUrl", "input", "text", $input_options, "プレビュー画像"),
    //         $get_form(null, "button", "button", $button_options),
    //     );
    //     break; --}}

    <h3>メッセージ</h3>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>タイプ</dt>
        <dd>画像<input type="hidden" name="type" value="image"></dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>メイン画像</dt>
        <dd>image area</dd>
        <dd>
            <button onclick="console.log(this);">画像選択</button>
            <input type="text" class="hidden">
        </dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>プレビュー画像(省略可能)</dt>
        <dd>image area</dd>
        <dd>
            <button onclick="console.log(this);">画像選択</button>
            <input type="text" class="hidden">
        </dd>
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
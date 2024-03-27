@php
    $values =   array();
    if(!is_null(old())){
        $values =   old();
    }
@endphp
<x-admin.api.line.frame.async title="商品作成 [オーダー]" heading="商品作成">
<x-slot name="head">
</x-slot>
<form>
    @csrf
    <x-admin.api.line.form.order.item :values="$values" :categories="$categories" :subcategories="$sub_categories" />
    <dl class="dl-flex-left dl-dt-120px">
        <dt></dt>
        <dd><button type="button" onclick="postCreateModal(this);">商品登録</button></dd>
    </dl>
</form>
<x-slot name="hidden">
</x-slot>
<x-slot name="script">
<script>
    function postCreateModal(button) {
        let validate    =   true;
        const formData  =   new FormData(button.closest("form"));
        button.closest("form").querySelectorAll("input, textarea, select").forEach(node=> node.required && !node.value ? validate = false : null);
        if(validate){
            const options   =   {
                "method"    :   "post",
                "body"      :   formData,
            }
            fetch("/api/line/{{ $channel->channel_name }}/order/item", options).then(response=>{
                if(response.ok){
                    window.frameElement.closest("div").classList.add("hidden");
                    window.parent.reloadItemOptions();
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
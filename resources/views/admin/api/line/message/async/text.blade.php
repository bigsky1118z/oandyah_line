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
    <x-admin.api.line.form.message.common />
    <x-admin.api.line.form.message.text />
    <dl class="dl-flex-left dl-dt-120px">
        <dt></dt>
        <dd><button type="button" data-path="message" onclick="postForm(this);">メッセージ登録</button></dd>
    </dl>
</form>
<x-slot name="hidden">
</x-slot>
<x-slot name="script">
<x-admin.api.line.script.async-post-form :channel="$channel" path="message" />
</x-slot>
</x-admin.api.frame.async>
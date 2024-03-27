@php
    $messages   =   App\Models\Api\LineApiMessage::whereChannelName($channel->channel_name)
                    // ->where("name","not like", "autofill%")
                    ->get();
@endphp
<x-admin.api.line.frame.modal :id="$id" type="message">
<dl class="dl-flex-left dl-dt-120px">
    <dt>タイプ</dt>
    <dd>
        <select name="history-type" onchange="console.log(this);">
            <option value="">---</option>
            <option value="text">テキスト</option>
            {{-- <option value="sticker">スタンプ</option> --}}
            <option value="image">画像</option>
            {{-- <option value="video">映像</option> --}}
            {{-- <option value="audio">音声</option> --}}
            <option value="location">位置情報</option>
            {{-- <option value="imagemap">imagemap</option> --}}
            <option value="template_buttons">選択ボタン</option>
            <option value="template_confirm">二択ボタン</option>
            <option value="template_carousel">カルーセル</option>
            <option value="template_image_carousel">画像カルーセル</option>
            {{-- <option value="flex_bubble">bubble</option> --}}
        </select>
    </dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>カテゴリ</dt>
    <dd>
        <select name="history-category">
            <option value="">---</option>
        </select>
    </dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>メッセージ名</dt>
    <dd>
        <select name="history-category">
            <option value="">---</option>
        </select>
    </dd>
</dl>
<form>
    @foreach ($messages as $message)
    <dl class="dl-flex-center">
        <dd class="select-dd"><input type="radio" name="history" id="history-message-object-{{ $message->id }}" data-type="{{ $message->type }}" data-category="{{ $message->category }}" data-name="{{ $message->name }}" value="{{ $message->id }}"></dd>
        <dd class="content-dd"></dd>
        <dd><button type="button">確認</button></dd>
        <dd></dd>
    </dl>
    @endforeach
</form>
</x-admin.api.line.frame.modal>
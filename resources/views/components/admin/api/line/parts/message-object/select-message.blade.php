<select class="addMessage addContent" onchange="addContent(this, 'create-message-object-input');" @isset($required) required @endisset"  @isset($id) id="{{ $id }}" @endisset  @isset($name) name="{{ $name }}" @endisset @isset($required) required @endisset>
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
    <option value="history">メッセージ履歴</option>
</select>
<button type="button" class="editMessage editContent hidden" onclick="editContent(this);">編集</button>
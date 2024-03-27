<select class="addEndpoint addContent required" onchange="addContent(this);" @isset($name) name="{{ $name }}" @endisset @isset($id) id="{{ $id }}" @endisset @isset($required) required @endisset>
    <option value="">---</option>
    <option value="push">送信相手を指定する</option>
    <option value="narrowcast">送信条件を指定する</option>
    <option value="broadcast">全員に送信する</option>
</select>
<button type="button" class="editEndpoint editContent" onclick="editContent(this);">編集</button>
<button type="button" class="clearEndpoint clearContent" onclick="clearContent(this);">クリア</button>

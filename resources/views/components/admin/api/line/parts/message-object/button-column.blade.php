<button type="button" class="addColumn addContent" onclick="addContent(this);" @isset($name) name="{{ $name }}" @endisset @isset($value) value="{{ $value }}" data-previous-value="{{ $value }}" @endisset>追加</button>
<button type="button" class="editColumn editContent" onclick="editContent(this);">編集</button>
<button type="button" class="clearColumn clearContent" onclick="clearContent(this);">クリア</button>
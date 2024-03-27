<select class="addContent addAction @isset($required) required @endisset" onchange="addContent(this);" @isset($id) id="{{ $id }}" @endisset @isset($name) name="{{ $name }}" @endisset @isset($required) required @endisset>
    <option value="">---</option>
    <option value="postback">postback</option>
    <option value="message">message</option>
    <option value="uri">uri</option>
    <option value="datetimepicker_date">date</option>
    <option value="datetimepicker_time">time</option>
    <option value="datetimepicker_datetime">datetime</option>
</select>
<button type="button" class="editAction editContent" @isset($name) @endisset onclick="editContent(this);">編集</button>
<button type="button" class="clearAction clearContent" @isset($name) @endisset onclick="clearContent(this);">クリア</button>

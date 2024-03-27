<input type="hidden" name="type" value="text">
<dl class="dl-flex-left dl-dt-120px">
    <dt>テキスト</dt>
    <dd><textarea name="text" rows="30" maxlength="5000" required>{{ isset($values["text"]) ? $values["text"] : null }}</textarea></dd>
</dl>
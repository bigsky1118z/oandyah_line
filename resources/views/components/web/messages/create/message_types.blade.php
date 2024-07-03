<select name="messages[{{ $index }}][type]" onchange="{{ $onchange ?? null }}" data-index="{{ $index }}" data-parent="{{ $parent ?? null }}">
    <option value="">---</option>
    <option value="text"        @selected("text" == ($object["type"] ?? null))>テキスト</option>
    <option value="image"       @selected("image" == ($object["type"] ?? null))>画像</option>
    <option value="template"    @selected("template" == ($object["type"] ?? null))>特殊メッセージ</option>
</select>
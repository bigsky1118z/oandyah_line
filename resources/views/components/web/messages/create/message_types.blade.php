<select name="messages[{{ $index }}][type]" onchange="{{ $onchange ?? null }}" data-index="{{ $index }}">
    <option value="">---</option>
    <option value="text"    @selected("text" == ($object["type"] ?? null))>テキスト</option>
    <option value="image"   @selected("image" == ($object["type"] ?? null))>画像</option>
</select>

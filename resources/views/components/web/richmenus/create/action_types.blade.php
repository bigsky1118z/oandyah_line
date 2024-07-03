<select name="{{ $name ?? null }}" onchange="{{ $onchange ?? null }}" data-index="{{ $index }}">
    <option value="">---</option>
    <option value="postback"        @selected("postback"        == ($object["type"] ?? null))>ポストバック</option>
    <option value="message"         @selected("message"         == ($object["type"] ?? null))>メッセージ</option>
    <option value="uri"             @selected("uri"             == ($object["type"] ?? null))>URL</option>
    <option value="datetimepicker"  @selected("datetimepicker"  == ($object["type"] ?? null))>日付選択</option>
    <option value="richmenuswitch"  @selected("richmenuswitch"  == ($object["type"] ?? null))>メニュー切り替え</option>
    <option value="clipboard"       @selected("clipboard"       == ($object["type"] ?? null))>クリップボード</option>
</select>
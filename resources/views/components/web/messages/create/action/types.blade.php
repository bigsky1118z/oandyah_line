@php
    $name   =   "";
    switch ($area ?? null) {
        case("default_action"):
            $name   =   "messages[".($index ?? 0)."][template][defaultAction]";
            break;
        case("actions"):
            $name   =   "messages[".($index ?? 0)."][template][actions][".($choice ?? 0)."]";
            $label  =   20;
            break;
        case("column_default_action"):
            $name   =   "messages[".($index ?? 0)."][template][column][".($column ?? 0)."][defaultAction]";
            break;
        case("column_actions"):
            $name   =   "messages[".($index ?? 0)."][template][column][".($column ?? 0)."][actions][".($choice ?? 0)."]";
            break;
        case("column_default_action"):
            $name   =   "messages[".($index ?? 0)."][template][column][".($column ?? 0)."][action]";
            break;
        case("richmenu_action"):
            $name   =   "areas[".( $index ?? 0 )."][action]";
            break;
    }
@endphp
<select name="{{ $name }}[type]"
    data-parent =   "{{ $parent ?? null }}"
    data-area   =   "{{ $area ?? null }}"
    data-index  =   "{{ $index ?? null }}"
    data-column =   "{{ $column ?? null }}"
    data-choice =   "{{ $choice ?? null }}"
    onchange    =   "select_action_type(this);" 
>
    <option value="">---</option>
    <option value="postback"        @selected("postback"        == ($action["type"] ?? null))>ポストバック</option>
    <option value="message"         @selected("message"         == ($action["type"] ?? null))>メッセージ</option>
    <option value="uri"             @selected("uri"             == ($action["type"] ?? null))>URL</option>
    <option value="datetimepicker"  @selected("datetimepicker"  == ($action["type"] ?? null))>日付選択</option>
    @if (($area ?? null) == "richmenu_action")
        <option value="richmenuswitch"  @selected("richmenuswitch"  == ($action["type"] ?? null))>メニュー切り替え</option>
    @endif
    <option value="clipboard"       @selected("clipboard"       == ($action["type"] ?? null))>クリップボード</option>
</select>
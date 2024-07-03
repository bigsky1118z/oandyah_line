@php
    $name   =   "";
    switch ($area ?? null) {
        case("default_action"):
            $name   =   "messages[".($index ?? 0)."][template][defaultAction]";
            break;
        case("actions"):
            $name   =   "messages[".($index ?? 0)."][template][actions][".($choice ?? 0)."]";
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
    }
@endphp
<div id="{{ $id ?? null }}">
    <ul>
        <li>
            <dl>
                <dt>送信されるメッセージ</dt>
                <dd><input type="text" name="{{ $name }}[text]" value="{{ $action["text"] ?? null }}"></dd>
            </dl>
        </li>
    </ul>
</div>

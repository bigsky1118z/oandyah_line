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
                <dt>リッチメニューエイリアスID</dt>
                <dd><input type="text" name="{{ $name }}[richMenuAliasId]" value="{{ $action["richMenuAliasId"] ?? null }}"></dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>データ</dt>
                <dd><input type="text" name="{{ $name }}[data]" value="{{ $action["data"] ?? null }}"></dd>
            </dl>
        </li>
    </ul>
</div>

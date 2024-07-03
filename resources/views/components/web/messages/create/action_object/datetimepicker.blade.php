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
                <dt>モード</dt>
                <dd>
                    <select name="{{ $name }}[mode]">
                        <option value="date" @selected("date" == ($action["mode"] ?? null))>日付を選択</option>
                        {{-- <option value="time" @selected("time" == ($action["mode"] ?? null))>時刻を選択</option>
                        <option value="datetime" @selected("datetime" == ($action["mode"] ?? null))>日付と日時を選択</option> --}}
                    </select>
                </dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>初期値</dt>
                <dd><input type="date" name="{{ $name }}[initial]" value="{{ $action["initial"] ?? null }}"></dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>最小値</dt>
                <dd><input type="date" name="{{ $name }}[min]" value="{{ $action["min"] ?? null }}"></dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>最大値</dt>
                <dd><input type="date" name="{{ $name }}[max]" value="{{ $action["max"] ?? null }}"></dd>
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

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
                <dt>データ</dt>
                <dd><input type="text" name="{{ $name }}[data]" value="{{ $action["data"] ?? null }}"></dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>表示されるメッセージ（任意）</dt>
                <dd><input type="text" name="{{ $name }}[displayText]" value="{{ $action["displayText"] ?? null }}"></dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>選択時のメニューの動き</dt>
                <dd>
                    <select name="{{ $name }}[inputOption]">
                        <option value="closeRichMenu"   @selected("closeRichMenu" == ($action["inputOption"] ?? null))>リッチメニューを閉じる</option>
                        <option value="openRichMenu"    @selected("openRichMenu" == ($action["inputOption"] ?? null))>リッチメニューを開く</option>
                        <option value="openKeyboard"    @selected("openKeyboard" == ($action["inputOption"] ?? null))>キーボードを開く</option>
                        <option value="openVoice"       @selected("openVoice" == ($action["inputOption"] ?? null))>ボイスメッセージ入力モードを開く</option>
                    </select>
                </dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>キーボードに予め入力されるメッセージ（任意）</dt>
                <dd><input type="text" name="{{ $name }}[fillInText]" value="{{ $action["fillInText"] ?? null }}"></dd>
            </dl>
        </li>
    </ul>
</div>

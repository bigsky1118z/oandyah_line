<div id="{{ $id ?? null }}">
    <ul>
        <li>
            <dl>
                <dt>データ</dt>
                <dd><input type="text" name="areas[{{ $index ?? 0 }}][action][data]" value="{{ $action["data"] ?? null }}"></dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>表示されるメッセージ（任意）</dt>
                <dd><input type="text" name="areas[{{ $index ?? 0 }}][action][displayText]" value="{{ $action["displayText"] ?? null }}"></dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>選択時のメニューの動き</dt>
                <dd>
                    <select name="areas[{{ $index ?? 0 }}][action][inputOption]">
                        <option value="closeRichMenu" @selected("closeRichMenu" == ($action["inputOption"] ?? null))>リッチメニューを閉じる</option>
                        <option value="openRichMenu" @selected("openRichMenu" == ($action["inputOption"] ?? null))>リッチメニューを開く</option>
                        <option value="openKeyboard" @selected("openKeyboard" == ($action["inputOption"] ?? null))>キーボードを開く</option>
                        <option value="openVoice" @selected("openVoice" == ($action["inputOption"] ?? null))>ボイスメッセージ入力モードを開く</option>
                    </select>
                </dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>キーボードに予め入力されるメッセージ（任意）</dt>
                <dd><input type="text" name="areas[{{ $index ?? 0 }}][action][fillInText]" value="{{ $action["fillInText"] ?? null }}"></dd>
            </dl>
        </li>
    </ul>
</div>

<div id="{{ $id ?? null }}">
    <ul>
        <li>
            <dl>
                <dt>コピーされる文字</dt>
                <dd><input type="text" name="areas[{{ $index ?? 0 }}][action][clipboardText]" value="{{ $action["clipboardText"] ?? null }}"></dd>
            </dl>
        </li>
    </ul>
</div>

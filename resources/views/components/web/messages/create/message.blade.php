<div id="{{ $id ?? null }}">
    <ul>
        <li>
            <dl>
                <dt>送信されるメッセージ</dt>
                <dd><input type="text" name="areas[{{ $index ?? 0 }}][action][text]" value="{{ $action["text"] ?? null }}"></dd>
            </dl>
        </li>
    </ul>
</div>

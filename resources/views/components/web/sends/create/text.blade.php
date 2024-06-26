<div id="{{ $id ?? null }}">
    <ul>
        <li>
            <dl>
                <dt>テキスト</dt>
                <dd><textarea class="send-messages-text-text" name="messages[{{ $index ?? 0 }}][text]">{{ $messages["text"] ?? null }}</textarea></dd>
            </dl>
        </li>
    </ul>
</div>

<div id="{{ $id ?? null }}">
    <ul>
        <li>
            <dl>
                <dt>テキスト</dt>
                <dd><textarea class="message-object-text-text" name="messages[{{ $index ?? 0 }}][text]" data-index="{{ $index ?? 0 }}">{{ $object["text"] ?? null }}</textarea></dd>
            </dl>
        </li>
    </ul>
</div>

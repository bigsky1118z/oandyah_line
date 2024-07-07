<div id="{{ $id ?? null }}">
    <p><textarea class="message-object-text-text" name="messages[{{ $index ?? 0 }}][text]" data-index="{{ $index ?? 0 }}" placeholder="テキストを入力してください">{{ $object["text"] ?? null }}</textarea></p>
</div>
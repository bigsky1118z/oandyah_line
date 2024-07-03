<div id="{{ $id ?? null }}" class="message-object-image">
    <table>
        <tbody>
            <tr>
                <td>
                    <dl>
                        <dd>
                            <input
                                class       =   "message-object-image-original_content_url-input"
                                name        =   "messages[{{ $index ?? 0 }}][originalContentUrl]"
                                value       =   "{{ $object["originalContentUrl"] ?? null }}"
                                onchange    =   "input_image_url(this);"
                                data-index  =   "{{ $index ?? 0 }}"
                                placeholder =   "画像URL"
                            />
                        </dd>
                        <dd><img class="message-object-image-original_content_url-img" src="{{ $object["originalContentUrl"] ?? null }}"></dd>
                        <dd><p class="message-object-image-original_content_url-message_box"></p></dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dd>
                            <input
                                class       =   "message-object-image-preview_image_url-input"
                                name        =   "messages[{{ $index ?? 0 }}][previewImageUrl]"
                                value       =   "{{ $object["previewImageUrl"] ?? null }}"
                                onchange    =   "input_image_url(this);"
                                data-index  =   "{{ $index ?? 0 }}"
                                placeholder =   "プレビュー画像URL"
                            />
                            </dd>
                        <dd><img class="message-object-image-preview_image_url-img" src="{{ $object["previewImageUrl"] ?? null }}"></dd>
                        <dd><p class="message-object-image-preview_image_url-message_box"></p></dd>
                    </dl>
                </td>
            </tr>
        </tbody>
    </table>
    {{-- <ul>
        <li>
            <dl>
                <dt>クリック時の画像</dt>
                <dd><input class="message-object-image-original_content_url-input" name="messages[{{ $index ?? 0 }}][originalContentUrl]" value="{{ $object["originalContentUrl"] ?? null }}" onchange="input_image_url(this);" data-index="{{ $index ?? 0 }}"></dd>
                <dd><img class="message-object-image-original_content_url-img" src="{{ $object["originalContentUrl"] ?? null }}"></dd>
                <dd><p class="message-object-image-original_content_url-message_box"></p></dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt>トーク画面上の画像</dt>
                <dd><input class="message-object-image-preview_image_url-input" name="messages[{{ $index ?? 0 }}][previewImageUrl]" value="{{ $object["previewImageUrl"] ?? null }}" onchange="input_image_url(this);" data-index="{{ $index ?? 0 }}"></dd>
                <dd><img class="message-object-image-preview_image_url-img" src="{{ $object["previewImageUrl"] ?? null }}"></dd>
                <dd><p class="message-object-image-preview_image_url-message_box"></p></dd>
            </dl>
        </li>
    </ul> --}}
</div>
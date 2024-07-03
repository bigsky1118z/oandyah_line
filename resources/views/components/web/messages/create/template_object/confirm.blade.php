<div id="{{ $id ?? null }}">
    <table>
        <tr>
        </tr>
        <tr>
            <th>画像URL</th>
            <td>
                <dl>
                    <dd>
                        <input
                            class="message-object-template-buttons-thumbnail_image_url-input"
                            name="messages[{{ $index ?? 0 }}][template][thumbnailImageUrl]" 
                            data-index="{{ $index ?? 0 }}"
                            onchange="input_image_url(this);"
                            placeholder="画像URL※任意"
                            value="{{ $object["template"]["thumbnailImageUrl"] ?? null }}"
                        />
                    </dd>
                    <dd>
                        <img
                            class="message-object-template-buttons-thumbnail_image_url-img"
                            src="{{ $object["template"]["thumbnailImageUrl"] ?? null }}"
                        />
                    </dd>
                    <dd><p class="message-object-template-buttons-thumbnail_image_url-message_box"></p></dd>
                </dl>
                <dl>
                    <dd>
                        <select name="messages[{{ $index ?? 0 }}][template][imageAspectRatio]">
                            <option value="rectangle">長方形（1.51:1）</option>
                            <option value="square">正方形（1:1）</option>
                        </select>
                    </dd>
                    <dd>
                        <select name="messages[{{ $index ?? 0 }}][template][imageSize]">
                            <option value="cover">切り詰め</option>
                            <option value="contain">全体を表示</option>
                        </select>
                    </dd>
                    <dd>
                        <input type="color" name="messages[{{ $index ?? 0 }}][template][imageBackgroundColor]">
                    </dd>
                </dl>
            </td>
        </tr>
        <tr>
            <th>タイトル</th>
            <td>
                <input type="text" name="messages[{{ $index ?? 0 }}][template][title]" value="{{ $object["template"]["title"] ?? null }}">
            </td>
        </tr>
        <tr>
            <th>文章</th>
            <td>
                <input type="text" name="messages[{{ $index ?? 0 }}][template][text]" value="{{ $object["template"]["text"] ?? null }}">
            </td>
        </tr>
        <tr>
            <th>本文選択時</th>
            <td>
                <ul>
                    <li class="action-type">
                        <x-web.messages.create.action_types 
                            parent="ul"
                            area="default_action"
                            :index="$index"
                            :action="($object['template']['defaultAction'] ?? array())"
                        />
                    </li>
                    <li class="action-object">
                        <x-web.messages.create.action_objects
                            id=""
                            area="default_action"
                            :index="$index"
                            :action="($object['template']['defaultAction'] ?? array())"
                        />
                    </li>
                </ul>
            </td>
        </tr>
        @for ($i = 0; $i < 4; $i++)
            <tr>
                <th>選択肢{{ $i+1 }}</th>
                <td>
                    <ul>
                        <li class="action-type">
                            <x-web.messages.create.action_types
                                parent="ul"
                                area="actions"
                                :index="$index"
                                :choice="$i"
                                :action="($object['template']['actions'][$i] ?? array())"
                            />
                        </li>
                        <li class="action-object">
                            <x-web.messages.create.action_objects
                                id="" 
                                area="actions"
                                :index="$index"
                                :choice="$i"
                                :action="($object['template']['actions'][$i] ?? array())"
                            />
                        </li>
                    </ul>
                </td>
            </tr>        
        @endfor
    </table>
</div>

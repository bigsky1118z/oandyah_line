<div id="{{ $id ?? null }}">
    <p>
        <span style="display:inline-block; background-color:#000000; border-radius: 45px; width: 45px; height: 45px"></span>
        <textarea class="message-object-template-altText" name="messages[{{ $index ?? 0 }}][altText]" data-index="{{ $index ?? 0 }}" placeholder="トーク一覧に表示されるメッセージ※必須" required>{{ $object["altText"] ?? null }}</textarea>
    </p>
    <table>
        <tbody>
            <tr>
                <td>
                    <select name="messages[{{ $index ?? 0 }}][template][type]" data-index="{{ $index ?? 0 }}" data-parent="table" onchange="select_template_type(this);" required>
                        <option value="">---</option>
                        <option value="buttons"         @selected("buttons"         == ($object["template"]["type"] ?? null))>ボタン</option>
                        <option value="confirm"         @selected("confirm"         == ($object["template"]["type"] ?? null))>確認</option>
                        <option value="carousel"        @selected("carousel"        == ($object["template"]["type"] ?? null))>リスト</option>
                        <option value="image_carousel"  @selected("image_carousel"  == ($object["template"]["type"] ?? null))>画像リスト</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="template-object">
                    <x-web.messages.create.template_objects :index="$index ?? 0" :object="$object ?? array()" />
                </td>
            </tr>
        </tbody>
    </table>
</div>
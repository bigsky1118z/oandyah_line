<x-admin.api.line.frame.modal :id="$id" type="action">
<form>
    <dl>
        <dt>画像選択</dt>
        <dd class="content-dd"></dd>
        <dd class="select-dd">
            <button type="button" onclick="imageSelectButton(this);">画像選択</button>
            <input type="text" class="addImage" name="imageUrl" accept="image/*" onchange="imageSelect(this);" style="display:none;">
        </dd>
    </dl>
    <dl>
        <dt>アクション</dt>
        <dd class="select-dd">
            <x-admin.api.line.parts.message-object.select-action name="action[type]" required="required" />
        </dd>
        <dd class="content-dd"></dd>
    </dl>
</form>
</x-admin.api.line.frame.modal>
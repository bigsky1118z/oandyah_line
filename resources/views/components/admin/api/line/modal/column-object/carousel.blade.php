<x-admin.api.line.frame.modal :id="$id" type="action">
<form>
    <dl class="carousel-image-url">
        <dt>画像</dt>
        <dd class="content-dd"></dd>
        <dd class="select-dd">
            <button type="button" onclick="imageSelectButton(this);">画像選択</button>
            <input type="text" class="addImage" name="thumbnailImageUrl" accept="image/*" onchange="imageSelect(this);" style="display:none;">
        </dd>
    </dl>
    <dl class="carousel-image-background-color">
        <dt>画像の背景色</dt>
        <dd><input type="color" name="imageBackgroundColor" value="#FFFFFF"></dd>
    </dl>
    <dl class="carousel-title">
        <dt>タイトル(最大40字)</dt>
        <dd><textarea name="title" rows="2" maxlength="40" required></textarea></dd>
    </dl>
    <dl class="carousel-text">
        <dt>メッセージテキスト(最大160字、画像またはタイトルを指定する場合は60文字)</dt>
        <dd><textarea name="text" rows="6" maxlength="120" required></textarea></dd>
    </dl>
    <dl class="carousel-default-action">
        <dt>デフォルトアクション</dt>
        <dd class="select-dd">
            <x-admin.api.line.parts.message-object.select-action name="defaultAction[type]"  />
        </dd>
        <dd class="content-dd"></dd>
    </dl>
    @foreach (range(0,2) as $number)
    <dl class="carousel-actions-{{ $number }}">
        <dt>アクション{{ $number + 1 }}</dt>
        <dd class="select-dd">
            <x-admin.api.line.parts.message-object.select-action name="actions[{{ $number }}][type]" >
            @if ($loop->first) <x-slot name="required">required</x-slot> @endif
            </x-admin.api.line.parts.message-object.select-action>
        </dd>
        <dd class="content-dd"></dd>
    </dl>
    @endforeach
</form>
</x-admin.api.line.frame.modal>
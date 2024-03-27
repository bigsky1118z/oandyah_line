<x-admin.api.line.frame.modal :id="$id" type="message">
<form>
    <dl>
        <dt>端末の通知やトークリストで表示するテキスト(最大400文字)</dt>
        <dd><textarea name="altText" rows="8" maxlength="400" required></textarea></dd>
    </dl>
    <div class="display-column">
        @foreach (range(0,9) as $number)
        <dl>
            <dt>画像カラム{{ $number + 1 }}</dt>
            <dd class="select-dd">
                <x-admin.api.line.parts.message-object.button-column name="template[columns][{{ $number }}][type]" value="image_carousel" />
            </dd>
            <dd class="content-dd"></dd>
        </dl>                
        @endforeach
    </div>
</form>
</x-admin.api.line.frame.modal>
<x-admin.api.line.frame.modal :id="$id" type="message">
<h3>カラム設定</h3>
<p>この設定はすべてのカラムに反映されます</p>
<x-admin.api.line.parts.message-object.config-column />
<h3>メッセージ作成</h3>
<form>
    <dl>
        <dt>端末の通知やトークリストで表示するテキスト(最大400文字)</dt>
        <dd><textarea name="altText" rows="8" maxlength="400" required></textarea></dd>
    </dl>
    <dl class="hidden">
        <dt>画像のアスペクト比</dt>
        <dd>
            <select name="template[imageAspectRatio]" class="carousel-image-aspect-ratio" disabled>
                <option value="">---</option>
                <option value="rectangle">長方形(1.51:1)</option>
                <option value="square">正方形</option>
            </select>
        </dd>
    </dl>
    <dl class="hidden">
        <dt>画像の表示形式</dt>
        <dd>
            <select name="template[imageSize]" class="carousel-image-size" disabled>
                <option value="">---</option>
                <option value="cover">画像を切り詰めて表示(余白なし)</option>
                <option value="contain">画像全体を表示(余白あり)</option>
            </select>
        </dd>
    </dl>
    <div class="display-column">
        @foreach (range(0,9) as $number)
        <dl>
            <dt>カラム{{ $number + 1 }}</dt>
            <dd class="select-dd">
                <x-admin.api.line.parts.message-object.button-column name="template[columns][{{ $number }}][type]" value="carousel" />
            </dd>
            <dd class="content-dd"></dd>
        </dl>                
        @endforeach
    </div>
</form>
</x-admin.api.line.frame.modal>
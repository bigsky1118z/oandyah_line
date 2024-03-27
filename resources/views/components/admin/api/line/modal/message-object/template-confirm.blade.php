<x-admin.api.line.frame.modal :id="$id" type="message">
<form>
    <dl>
        <dt>端末の通知やトークリストで表示するテキスト(最大400文字)</dt>
        <dd><textarea name="altText" rows="8" maxlength="400" required></textarea></dd>
    </dl>
    <dl>
        <dt>メッセージテキスト(最大240字)</dt>
        <dd><textarea name="template[text]" rows="8" maxlength="240" required></textarea></dd>
    </dl>
    @foreach (range(0,1) as $number)
    <dl>
        <dt>アクション{{ $number + 1 }}</dt>
        <dd class="select-dd">
            <x-admin.api.line.parts.message-object.select-action name="template[actions][{{ $number }}][type]" required="required" />    
        </dd>
        <dd class="content-dd"></dd>
    </dl>                
    @endforeach
</form>
</x-admin.api.line.frame.modal>
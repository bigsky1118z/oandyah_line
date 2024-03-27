<x-admin.api.line.frame.modal :id="$id" type="message">
<form>
    <dl>
        <dt>端末の通知やトークリストで表示するテキスト(最大400文字)</dt>
        <dd><textarea name="altText" rows="8" maxlength="400" required></textarea></dd>
    </dl>
    <dl>
        <dt>タイトル(最大40字)</dt>
        <dd><textarea name="template[title]" rows="2" maxlength="40"></textarea></dd>
    </dl>
    <dl>
        <dt>メッセージテキスト(最大160字、画像またはタイトルを指定する場合は60文字)</dt>
        <dd><textarea name="template[text]" rows="6" maxlength="160" required></textarea></dd>
    </dl>
    <dl>
        <dt>デフォルトアクション</dt>
        <dd class="select-dd">
            <x-admin.api.line.parts.message-object.select-action name="template[defaultAction][type]" />
        </dd>
        <dd class="content-dd"></dd>
    </dl>
    @foreach (range(0,3) as $number)
    <dl>
        <dt>アクション{{ $number + 1 }}</dt>
        <dd class="select-dd">
            <x-admin.api.line.parts.message-object.select-action name="template[actions][{{ $number }}][type]">
            @if ($loop->first) <x-slot name="required">required</x-slot> @endif
            </x-admin.api.line.parts.message-object.select-action>
        </dd>
        <dd class="content-dd"></dd>
    </dl>
    @endforeach
</form>
</x-admin.api.line.frame.modal>
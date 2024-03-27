<x-admin.api.line.frame.modal :id="$id" type="action">
<form>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>ラベル</dt>
        <dd><input type="text" name="label" required></dd>
    </dl>
    <x-admin.api.line.parts.message-object.select-postback />
    <dl class="dl-flex-left dl-dt-120px">
        <dt>初期値</dt>
        <dd><input type="datetime-local" name="initial"></dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>最大値</dt>
        <dd><input type="datetime-local" name="max"></dd>
    </dl>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>最小値</dt>
        <dd><input type="datetime-local" name="min"></dd>
    </dl>
    <dl>
        <dt>自動返答メッセージ</dt>
        {{-- <dd><textarea name="fillInText" rows="8" maxlength="5000"></textarea></dd> --}}
    </dl>
</form>
</x-admin.api.line.frame.modal>
<x-admin.api.line.frame.modal :id="$id" type="action">
<form>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>ラベル</dt>
        <dd><input type="text" name="label" required></dd>
    </dl>
    <dl>
        <dt>ユーザーのメッセージとして表示されるテキスト</dt>
        <dd><textarea name="text" rows="8" required maxlength="300"></textarea></dd>
    </dl>
    <dl>
        <dt>自動返答メッセージ</dt>
        {{-- <dd><textarea name="fillInText" rows="8" maxlength="5000"></textarea></dd> --}}
    </dl>
</form>
</x-admin.api.line.frame.modal>
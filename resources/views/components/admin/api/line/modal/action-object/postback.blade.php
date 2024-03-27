<x-admin.api.line.frame.modal :id="$id" type="action">
<form>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>ラベル</dt>
        <dd><input type="text" name="label" required></dd>
    </dl>
    <x-admin.api.line.parts.message-object.select-postback />
    <dl>
        <dt>選択時のメニュー操作</dt>
        <dd><select name="inputOption">
                <option value="">---</option>
                <option value="closeRichMenu">リッチメニューを閉じる</option>
                <option value="openRichMenu">リッチメニューを開く</option>
                <option value="openKeyboard">キーボードを開く</option>
                <option value="openVoice">ボイスメッセージ入力モードを開く</option>
            </select>
        </dd>
    </dl>
    <dl>
        <dt>入力欄にあらかじめ入力しておく文字（キーボードを開くのときのみ、最大300文字）</dt>
        <dd><textarea name="fillInText" rows="8" maxlength="300"></textarea></dd>
    </dl>
    <dl>
        <dt>ユーザーのメッセージとして表示されるテキスト（最大300文字）</dt>
        <dd><textarea name="displayText" rows="8" maxlength="300"></textarea></dd>
    </dl>
    <dl>
        <dt>自動返答メッセージ</dt>
        {{-- <dd><textarea name="fillInText" rows="8" maxlength="5000"></textarea></dd> --}}
    </dl>
</form>
</x-admin.api.line.frame.modal>
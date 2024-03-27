<x-admin.api.line.frame.modal :id="$id" type="message">
<form>
    <dl>
        <dt>場所</dt>
        <dd><input type="text" name="title" required></dd>
    </dl>
    <dl>
        <dt>住所</dt>
        <dd><input type="text" name="address" required></dd>
    </dl>
    <dl>
        <dt>経度</dt>
        <dd><input type="number" name="latitude" required step="0.00000001"></dd>
    </dl>
    <dl>
        <dt>緯度</dt>
        <dd><input type="number" name="longitude" required step="0.00000001"></dd>
    </dl>
</form>
</x-admin.api.line.frame.modal>
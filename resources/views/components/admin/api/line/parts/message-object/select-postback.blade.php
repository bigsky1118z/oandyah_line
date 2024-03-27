@php
    use App\Models\Api\LineApiReply ;
@endphp
<dl class="dl-flex-left dl-dt-120px">
    <dt>機能</dt>
    <dd>
        <select name="data[action]" required>
            <option value="">---</option>
            @foreach (LineApiReply::$postback_action_names as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    </dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>イベント名</dt>
    <dd><input type="text" name="data[name]" required></dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>詳細</dt>
    <dd><input type="text" name="data[detail]"></dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>補足</dt>
    <dd><input type="text" name="data[extra]"></dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>値</dt>
    <dd><input type="text" name="data[value]"></dd>
</dl>
<dl class="dl-flex-left dl-dt-120px">
    <dt>ユーザーID</dt>
    <dd><input type="checkbox" name="data[user_id]" value="user_id"></dd>
</dl>

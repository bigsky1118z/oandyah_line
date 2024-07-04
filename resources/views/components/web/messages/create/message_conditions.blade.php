@php
    use App\Models\App\AppMessage ;
@endphp
<table id="message-condition">
    <tbody>
        <tr>
            <th>メッセージ名</th>
            <td><input type="text" name="name" value="{{ $message->name ?? null }}"></td>
        </tr>
        <tr>
            <th>送信方法</th>
            <td>
                <select name="type" onchange="select_send_type(this);">
                    <option value="">---</option>
                    @foreach (AppMessage::$types as $key => $value)
                        <option value="{{ $key }}" @selected($key == $message->type) @disabled($key == "reply")>{{ $value }}</option>
                    @endforeach
                </select>
            </td>
            <td id="message-type-option">
                @switch($message->type ?? null)
                    @case("push")       <x-web.messages.create.type.push id="" :friends="$app->friends" :checked="$message->push" />    @break
                    {{-- @case("narrowcast") <x-web.messages.create.type.push id="" :friends="$app->friends" :checked="$message->push" />    @break --}}
                @endswitch
            </td>
        </tr>
        <tr>
            <th>通知設定</th>
            <td>
                <select name="notification_disabled">
                    <option value="0" @selected($message->notification_disabled == false ?? false)>通知する</option>
                    <option value="1" @selected($message->notification_disabled == true  ?? false)>通知しない</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>時間指定</th>
            <td><input type="datetime-local" name="datetime" value="{{ $message->datetime ?? null }}"></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>
            </td>
        </tr>
    </tfoot>
</table>

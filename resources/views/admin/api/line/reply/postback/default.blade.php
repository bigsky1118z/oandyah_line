<x-admin.api.line.frame.basic title="自動返信" heading="自動返信" :channel="$channel">
<x-slot name="head">
</x-slot>
<dl class="dl-flex-left">
    <dt><h3>{{ $action_names[$action] }}</h3></dt>
    <dd><p><a href="#">{{ $action_names[$action] }}を新規作成する</a></p></dd>
</dl>
<form>
    <table>
        <thead>
            <tr>
                <th>登録</th>
                <th>名前</th>
                <th>メッセージ</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grouped_replies as $name => $replies)
                @foreach ($replies as $reply)
                    <tr>
                        <td><input type="checkbox" id="postback-default-{{ $reply->id }}" name="postback-default-{{ $reply->id }}" value="{{ $reply->id }}" onchange="changeDefaultMessage(this);" @if ($reply->active) checked @endif></td>
                        <td><label for="postback-default-{{ $reply->id }}">{{ $reply->name ? $reply->name : "no name" }}</label></td>
                        <td>
                            <ul>
                                @foreach ($reply->get_line_api_messages() as $message)
                                <li>{!! $message->get_display_message() !!}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <p>
                                <a href="/api/line/{{ $channel->channel_name }}/reply/postback/{{ $action }}/{{ $reply->id }}">詳細</a>
                                <a href="/api/line/{{ $channel->channel_name }}/reply/postback/{{ $action }}/{{ $reply->id }}/edit">編集</a>
                                <a href="/api/line/{{ $channel->channel_name }}/reply/postback/{{ $action }}/{{ $reply->id }}/delete">削除</a>
                            </p>
                        </td>
                    </tr>
                @endforeach
            @endforeach
            @if ($grouped_replies->isEmpty())
            <tr>
                <td colspan="4">デフォルトメッセージはありません</td>
            </tr>
            @endif
        </tbody>
    </table>
</form>
<x-slot name="script">
<script>
    function changeDefaultMessage(param){
        const form  =   param.closest("form");
        let active, inactive;
        if(param.checked){
            active   =   param.value;
            form.querySelectorAll("input[type=checkbox]").forEach(checkbox=>{
                if(checkbox.checked && checkbox != param){
                    inactive             =   checkbox.value;
                    checkbox.checked    =   false;
                }
            });
        } else {
            inactive =   param.value;
        }
        const formData  =   new FormData();
        if(active){
            formData.append("active", active);
        }
        if(inactive){
            formData.append("inactive", inactive);
        }
        const options   =   {
            "method"    :   "post",
            "body"      :   formData,
        };
        fetch("/api/line/{{ $channel->channel_name }}/reply/postback/default/active", options)
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('HTTP status code: ' + response.status);
            }
        }).then(data => {
            const div =   document.createElement("div");
            div.classList.add("notification-banner");

            data.messages.forEach(message=>div.textContent += message);
            document.querySelector("body").appendChild(div);
            setTimeout(function() {
                div.remove();
            }, 2000);

        }).catch(error => console.error(error));

        console.log(active, inactive);
    }
</script>
</x-slot>
</x-admin.api.frame.basic>
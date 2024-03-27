<table>
    <thead>
        <tr>
            {{-- 時間 --}}
            @switch($type)
                @case("error") @case("sent") 
                    <th>送信時間</th>
                    @break
                @case("reserve") 
                    <th>予約時間</th>
                    @break
            @endswitch
            {{-- 送信相手・メッセージタイプ・通知 --}}
            @switch($type) @case("error") @case("draft") @case("reserve") @case("sent") 
                <th>送信相手</th>
                <th>メッセージ</th>
                <th>通知設定</th>
            @endswitch
            {{-- レスポンス --}}
            @switch($type) @case("error") @case("draft") @case("reserve") @case("sent") 
                <th>検証</th>
                <th>検証詳細</th>
            @endswitch
            {{-- 操作 --}}
            @switch($type)
                @case("error") @case("draft") @case("reserve")
                    <th colspan="2">操作</th>
                    @break
                @case("sent") 
                    <th>操作</th>
            @endswitch
        </tr>
    </thead>
    <body>
        @foreach ($sends as $send)
            <tr>
                {{-- 時間 --}}
                @switch($type)
                        @case("error") @case("sent") 
                            <td>{{ $send->sent_at }}</td>
                            @break
                        @case("reserve") 
                            <td>{{ $send->schedule_at }}</td>
                            @break
                @endswitch
                {{-- 送信相手・メッセージタイプ・通知 --}}
                @switch($type) @case("error") @case("draft") @case("reserve") @case("sent") 
                    @switch($send->endpoint_type)
                        @case("reply")
                            <td>{{ $send->to ? $send->user->nickname() : null }}[自動返信]</td>
                            @break
                        @case("push")
                            <td>{{ $send->to ? $send->user->nickname() : null }}</td>
                            @break
                        @case("broadcast")
                            <td>全員</td>
                            @break
                        @default
                            <td></td>
                    @endswitch
                    <td>
                        <ul>
                            @foreach ($send->get_line_api_messages() as $line_api_message)
                            <li>{{ $line_api_message->get_message_type() }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $send->notification_disabled ? "非通知" : "通知" }}</td>
                @endswitch
                {{-- レスポンス --}}
                @switch($type)
                    @case("sent") @case("error") 
                        <td>{{ $send->response_status==200 ? "正常" : "エラー" }}</td>
                        <td>
                            {{ $send->response_error_message }}
                            @isset($send->response_error_details)
                            <ul>
                                @foreach ($send->response_error_details as $response_error_detail)
                                    @foreach ($response_error_detail as $key => $value)
                                    <li>{{ $key }} : {{ $value }}</li>
                                    @endforeach
                                @endforeach
                            </ul>                    
                            @endisset
                        </td>
                        @break;
                    @case("draft") @case("reserve") 
                        <td>{{ $send->validate_status==200 ? "正常" : "エラー" }}</td>
                        <td>{{ $send->validate_status }}</td>
                        <td>
                            {{ $send->validate_error_message }}
                            @isset($send->validate_error_details)
                            <ul>
                                @foreach ($send->validate_error_details as $validate_error_detail)
                                    @foreach ($validate_error_detail as $key => $value)
                                    <li>{{ $key }} : {{ $value }}</li>
                                    @endforeach
                                @endforeach
                            </ul>                    
                            @endisset
                        </td>
                        @break
                @endswitch
                {{-- 操作 --}}
                @switch($type)
                    @case("error") @case("draft") @case("reserve")
                        <td>詳細</td>
                        <td><a href="/api/line/{{ $send->channel_name }}/send/{{ $send->id }}/delete">削除</a></td>
                        @break
                    @case("sent")
                        <td>詳細</td>
                        @break
                @endswitch
            </tr>
        @endforeach
    </body>
</table>

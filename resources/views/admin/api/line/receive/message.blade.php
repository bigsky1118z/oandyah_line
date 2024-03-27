<x-admin.api.line.frame.basic title="受信メッセージ" heading="受信メッセージ" :channel="$channel">
<x-slot name="head">
<style>
    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }
</style>
</x-slot>
<h3>メッセージログ</h3>
 <table>
    <thead>
        <tr>
            <th>名前</th>
            <th>メッセージ</th>
            <th>自動返信</th>
            <th>返信</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($messages as $message)
        @isset($message->event)
        <tr>
            <td>{{ $message->user->nickname() }}</td>
            @switch($message->event['type'])
                @case("text")
                    <td>{{ $message->event['text'] }}</td>
                    @break
                @case("image")
                    <td>{!!  $message->get_content("auto", 100)  !!}</td>
                    @break
                @case("sticker")
                    <td>{{ $message->get_sticker() }}</td>
                    @break
                @default
                    <td>{{ $message->event['type'] }}</td>
            @endswitch
            <td>{{ $message->response_status==200 }}</td>
            <td><a href="{{ $message->channel->get_chat_url() }}" target="_blank" rel="noopener noreferrer">個別チャット</a></td>
        </tr>
        @endisset
        @endforeach
    </tbody>
</table>
</x-admin.api.line.frame.basic>
@php
    use App\Models\Line\LineMessage;
    $types  =   LineMessage::$types;
@endphp
<x-line.frame.basic>
<x-slot name="id">message</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
{{-- <x-slot name="head"></x-slot> --}}
{{-- <x-slot name="header"></x-slot> --}}
<h2><a href="/line/{{ $line->name }}">{{ $line->display_name }}</a> > 送信メッセージ</h2>
<section id="index">
    <p><button onclick="location.href='/line/{{ $line->name }}/message/create'">新規作成</button></p>
    <h3>一覧</h3>
    <dl id="dl-line-message-index">
        <dt class="dt-line-message-index-header">
            <dl>
                <dd class="dd-line-message-index-group" style="display:flex;">
                    <dl class="dl-line-message-index-group-0">
                        <dd class="dd-line-message-index-type">種類</dd>
                        <dd class="dd-line-message-index-status">状態</dd>
                    </dl>
                    <dl class="dl-line-message-index-group-1">
                        <dd class="dd-line-message-index-message">メッセージ</dd>
                    </dl>
                    <dl class="dl-line-message-index-group-2">
                        <dd class="dd-line-message-index-count">ステータス</dd>
                    </dl>
                    <dl class="dl-line-message-index-group-button">
                        <dd class="dd-line-message-index-button">操作</dd>
                    </dl>
                </dd>
            </dl>
        </dt>
        <dd>
            <dl>
                @foreach ($line->messages->reverse() as $message)
                    <dd class="dd-line-message-index-group dd-line-message-status-{{ $message->status }}" data-status="{{ $message->status }}" data-type="{{ $message->type }}" style="display:flex;">
                        <dl class="dl-line-message-index-group-0">
                            <dd class="dd-line-message-index-type">{{ $types[$message->type] ?? $message->type }}</dd>
                            <dd class="dd-line-message-index-status">{{ $message->status }}</dd>
                        </dl>
                        <dl class="dl-line-message-index-group-1">
                            @foreach ($message->message_objects as $message_object)
                            <dd class="dd-line-message-index-message">
                                <dl>
                                    <dd class="dd-line-message-index-message-type">{{  $message_object->type  }}</dd>
                                    <dd class="dd-line-message-index-message-name">{{  $message_object->get_value("name")  }}</dd>
                                </dl>
                            </dd>
                            @endforeach
                        </dl>
                        <dl class="dl-line-message-index-group-2">
                            @switch($message->status)
                                @case("sent")
                                    <dd class="dd-line-message-index-date">{{ $message->send_date }}</dd>
                                    @break
                                @case("error")
                                    <dd>{{ json_encode($message->error_message) }}</dd>
                                    @break
                                @case("draft")
                                @default
                                    @break
                            @endswitch
                        </dl>
                        <dl class="dl-line-message-index-group-button">
                            @if (in_array($message->status, array("draft","error")))
                                <dd><button type="button" onclick="location.href = '/line/{{ $line->name }}/message/{{ $message->id }}/edit'">編集</button></dd>
                            @endif
                            @if (in_array($message->status, array("draft")))
                                <dd><button type="button" onclick="location.href = '/line/{{ $line->name }}/message/{{ $message->id }}/sending'">送信</button></dd>
                            @endif
                            @if (in_array($message->status, array("draft","error")))
                                <dd><button type="button" onclick="location.href = '/line/{{ $line->name }}/message/{{ $message->id }}/delete'">削除</button></dd>
                            @endif
                        </dl>
                    </dd>
                @endforeach
            </dl>
        </dd>
    </dl>
</section>
<x-slot name="footer"></x-slot>
<x-slot name="hidden"></x-slot>
<x-slot name="script"></x-slot>
</x-line.frame.basic>
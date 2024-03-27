<x-line.frame.basic>
<x-slot name="id">line</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
{{-- <x-slot name="head"></x-slot> --}}
{{-- <x-slot name="header"></x-slot> --}}
<h2><a href="/line/{{ $line->name }}">{{ $line->display_name }}</a></h2>
<section id="line">
    <dl id="dl-line-show">
        <dd>
            <dl class="dl-flex">
                <dt>name</dt>
                <dd>{{ $line->name }}</dd>
            </dl>
            <dl class="dl-flex">
                <dt>line_user_id</dt>
                <dd>{{ $line->line_user_id }}</dd>
            </dl>
            <dl class="dl-flex">
                <dt>basic_id</dt>
                <dd>{{ $line->basic_id }}</dd>
            </dl>
            <dl class="dl-flex">
                <dt>display_name</dt>
                <dd>{{ $line->display_name }}</dd>
            </dl>
            <dl class="dl-flex">
                <dt>picture_url</dt>
                <dd>{{ $line->picture_url }}</dd>
            </dl>
            <dl class="dl-flex">
                <dt>chat_mode</dt>
                <dd>{{ $line->chat_mode }}</dd>
            </dl>
            <dl class="dl-flex">
                <dt>mark_as_read_mode</dt>
                <dd>{{ $line->mark_as_read_mode }}</dd>
            </dl>
            <dl class="dl-flex">
                <dt>endpoint</dt>
                <dd>{{ $line->get_bot_channel_webhook_endpoint() }}</dd>
            </dl>
        </dd>
    </dl>
</section>
<section id="system">
    <dl id="dl-line-system">
        <dd><a href="/line/{{ $line->name }}/friend">友だち</a></dd>
        <dd><a href="/line/{{ $line->name }}/group">グループ</a></dd>
        <dd><a href="/line/{{ $line->name }}/webhook">webhook</a></dd>
        <dd><a href="/line/{{ $line->name }}/message">送信メッセージ</a></dd>
    </dl>
</section>

<x-slot name="footer"></x-slot>
<x-slot name="hidden"></x-slot>
<x-slot name="script"></x-slot>
</x-line.frame.basic>
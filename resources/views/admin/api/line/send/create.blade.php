<x-admin.api.line.frame.basic :channel="$channel" title="新規メッセージ作成" heading="新規メッセージ作成">
<x-slot name="head">
</x-slot>
<h3>メッセージ作成</h3>
<div id="create-message-objects" class="create-message-objects">
    <section id="create-message-object-messages" class="create-message-object-messages">
        <form action="/api/line/{{ $channel->channel_name }}/send/create" method="post">
            @csrf
            <div id="create-message-object-messages-options" class="options-messages div-dl-dt-150px">
                <h4>送信条件</h4>
                <x-admin.api.line.form.schedule :channel="$channel" />
                <x-admin.api.line.form.endpoint :channel="$channel" />
                <x-admin.api.line.form.unit :channel="$channel" />
                <x-admin.api.line.form.notification :channel="$channel" />
            </div>
            <div id="create-message-object-messages-type" class="select-messages">
                <h4>メッセージ</h4>
                <x-admin.api.line.form.message-object :channel="$channel" />
            </div>
            <p><input type="submit" value="send"></p>
        </form>
    </section>
    <section id="create-message-object-input" class="create-message-object-input">

    </section>
    <section id="create-message-object-action" class="create-message-object-action">

    </section>
    
</div>
<x-slot name="modal">
    <x-admin.api.line.modal.endpoint.endpoints :channel="$channel" />
    <x-admin.api.line.modal.message-object.message-objects :channel="$channel" />
    <x-admin.api.line.modal.action-object.action-objects :channel="$channel" />
    <x-admin.api.line.modal.column-object.column-objects :channel="$channel" />
</x-slot>

<x-slot name="script">
    <x-admin.api.line.script.schedule :channel="$channel" />
    <x-admin.api.line.script.create-message-object :channel="$channel" />
    {{-- <x-admin.api.line.script.modal :channel="$channel" /> --}}
</x-slot>

</x-admin.api.line.frame.basic>
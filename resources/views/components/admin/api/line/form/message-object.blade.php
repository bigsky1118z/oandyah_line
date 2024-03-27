@foreach (range(0,4) as $number)
<dl class="dl-flex-left">
    <dt class="count-dt">{{ $number + 1 }}</dt>
    <dd class="select-dd">
        <x-admin.api.line.parts.message-object.select-message id="messages-{{ $number }}-type" name="messages[{{ $number }}][type]">
        @if ($loop->first) <x-slot name="required">required</x-slot> @endif
        </x-admin.api.line.parts.message-object.select-message>
    </dd>
    <dd class="content-dd"></dd>
</dl>
@endforeach
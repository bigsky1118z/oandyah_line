@php
$units  =   App\Models\Api\LineApiSend::whereChannelName($channel->channel_name)
    ->where("response_status",200)
    ->where("custom_aggregation_units", "not like", "autofill%")
    ->whereNotNull("custom_aggregation_units")
    ->distinct()
    ->pluck("custom_aggregation_units");
@endphp
<dl @isset($classdl) class="{{ $classdl }}" @endisset>
    <dt>統計分析ユニット</dt>
    <dd class="content-dd"><input type="text" class="addUnit" name="customAggregationUnits[]" list="old-units" autocomplete="off"></dd>
    <datalist id="old-units">
        @foreach ($units as $unit)
        <option>{{ $unit }}</option>
        @endforeach
    </datalist>

</dl>
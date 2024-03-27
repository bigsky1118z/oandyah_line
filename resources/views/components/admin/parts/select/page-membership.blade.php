@php
    use App\Models\Website\Page;
@endphp
@props(array(
    'name'          =>  null,
    'id'            =>  null,
    'onchange'      =>  null,
    'value'         =>  null,
))
<select
    @if ($name) name="{{ $name }}" @endif
    @if ($id) id="{{ $id }}" @endif
    @if ($onchange) onchange="{{ $onchange }}" @endif
>
    <option value="">選択してください</option>
    @foreach (Page::$membership_rules as $membership => $display)
    <option value="{{ $membership }}" @if ($value == $membership) selected @endif>{{ $display }}</option>
    @endforeach
</select>
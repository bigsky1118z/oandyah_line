@php
    use App\Models\Website\Layout;
@endphp
@props(array(
    'name'          =>  null,
    'id'            =>  null,
    'onchange'      =>  null,
    'value'         =>  null,
    'isMenu'        =>  false,
))
<select
    @if ($name) name="{{ $name }}" @endif
    @if ($id) id="{{ $id }}" @endif
    @if ($onchange) onchange="{{ $onchange }}" @endif
>
    <option value="">選択してください</option>
    @foreach (Layout::$layout_names as $name => $title)
        <option value="{{ $name }}" @if ($value == $name) selected @endif>{{ $title }}</option>
    @endforeach
</select>
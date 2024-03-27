@php
    use App\Models\Website\Top;
@endphp
@props(array(
    'id'        =>  null,
    'value'     =>  null,
    'name'      =>  null,
    'parent'    =>  null,
))
<select
    @if ($id) id="{{ $id }}" @endif
    @if ($name) name="{{ $name }}" @endif
>
    @foreach (Top::$options[$parent] as $key => $option)
    <option value="{{ $key }}" @if ($value == $key ) selected @endif>{{ $option }}</option>
    @endforeach
</select>
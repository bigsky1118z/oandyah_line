@php
    use App\Models\Website\Header;
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
    @foreach (Header::$options[$parent] as $key => $option)
    <option value="{{ $key }}" @if ($value == $key ) selected @endif>{{ $option }}</option>
    @endforeach
</select>
@php
    use App\Models\Websites\Head;
@endphp
@props(array(
    'id'        =>  null,
    'name'      =>  null,
    'value'     =>  null,
    'onchange'  =>  null,
))
<select
    @if ($id) id="{{ $id }}" @endif
    @if ($name) name="{{ $name }}" @endif
    @if ($onchange) onchange="{{ $onchange }}" @endif
>
    <option value="">-----</option>
    @foreach (Head::$tags as $tag)
    <option value='{{ $tag }}' @if($tag == $value ) selected @endif>{{ $tag }}</option>
    @endforeach
</select>
@props(array(
    'id'    =>  null,
    'name'  =>  null,
    'value' =>  null,
))
<select
    @if ($id) id="{{ $id }}" @endif
    @if ($name) name="{{ $name }}" @endif
>
    @foreach (range(1, 50) as $number)
        <option value='{{ $number }}' @if($number == $value ) selected @endif>{{ $number }}</option>
    @endforeach
</select>
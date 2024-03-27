@php
    use App\Models\Website\Page;
@endphp
@props(array(
    'id'        =>  null,
    'value'     =>  null,
    'name'      =>  null,
    'onchange'  =>  null,
    'parent'    =>  null,
))
<select
    @if ($id) id="{{ $id }}" @endif
    @if ($name) name="{{ $name }}" @endif
    @if ($onchange) onchange="{{ $onchange }}" @endif
>
    <option value="">選択してください</option>
    @foreach (Page::whereParent($parent)->get() as $item)
    <option value="{{ $item->name }}" @if ($value == $item->name) selected @endif>{{ $item->title }}</option>
    @endforeach
</select>
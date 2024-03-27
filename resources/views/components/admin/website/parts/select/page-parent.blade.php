@php
    use App\Models\Website\Page;
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
    @foreach (Page::$page_parents as $parent => $title)
    <option value="{{ $parent }}" @if ($value == $parent) selected @endif>{{ $title }}</option>
    @endforeach
    @if ($isMenu)
    <option value="extension" @if ($value == "extension") selected @endif>任意リンク</option>
    @endif
</select>
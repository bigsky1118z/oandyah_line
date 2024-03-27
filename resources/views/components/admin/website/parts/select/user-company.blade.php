@php
    use App\Models\Webapp\Company;
@endphp
@props(array(
    'id'    =>  null,
    'value' =>  null,
    'name'  =>  null,
))
<select
    @if ($id) id="{{ $id }}" @endif
    @if ($name) name="{{ $name }}" @endif
>
    <option value="">----------</option>
    @foreach (Company::all() as $company)
    <option value="{{ $company->id }}" @if ($value == $company->id) selected @endif>{{ $company->name }}</option>
    @endforeach
</select>
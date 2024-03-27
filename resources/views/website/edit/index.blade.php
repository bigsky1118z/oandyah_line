<x-website.frame.edit>
<x-slot name="title">edit</x-slot>
<x-slot name="id">top</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
{{-- <x-slot name="h1"></x-slot> --}}
{{-- <x-slot name="h2"></x-slot> --}}
<h2>ウェブサイト編集 TOP</h2>
<section id="index">
    <dl id="dl-top-index">
        @foreach ($edits as $edit => $value)
            <dd>
                <dl>
                    <dt class="dt-edit-top-index-title">{{ isset($value["title"]) ? $value["title"] : "---" }}</dt>
                    <dd class="dd-edit-top-index-description">{{ isset($value["description"]) ? $value["description"] : "---" }}</dd>
                    <dd class="dd-edit-top-index-button"><button type="button" onclick="location.href='/edit/{{ $edit }}'">移動</button></dd>
                </dl>
            </dd>
        @endforeach
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>    
</x-website.frame.edit>
<x-website.frame.edit>
<x-slot name="title">layout</x-slot>
<x-slot name="id">layout</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/edit/layout">layout</a></x-slot>
<section id="index">
    <dl>
        <dt></dt>
        @foreach ($types as $type_key => $type_value)
        <dd>
            <dl class="dl-flex">
                <dt>{{ $type_value }}</dt>
                @foreach (array("header","main","footer") as $target)
                    <dd>{{ isset($layouts[$type_key], $layouts[$type_key]->groupBy("target")[$target]) ? $layouts[$type_key]->groupBy("target")[$target]->count() : 0 }}</dd>
                @endforeach
                <dd><button type="button" onclick="location.href='/edit/layout/{{ $type_key }}'">edit</button></dd>
            </dl>
        </dd>
        @endforeach
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>    
    
</x-website.frame.edit>
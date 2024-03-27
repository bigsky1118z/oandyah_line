<x-jinguji_ozora.frame.basic>
@if (isset($spreads))
    <x-slot name="title">究極の未来へ導くタロットリーディング [究極の未来へ導く占い師 神宮寺大空]</x-slot>
@elseif(isset($spread))
    <x-slot name="title">{{ $spread["title"] }} [究極の未来へ導く占い師 神宮寺大空]</x-slot>
@endif
<x-slot name="id">tarot</x-slot>
<x-slot name="head">
</x-slot>
<h2>究極の未来へ導くタロットリーディング</h2>
@if(isset($spreads))
    <section id="index">
        <x-jinguji_ozora.tarot.index :spreads="$spreads" />
    </section>
@elseif (isset($all))
    <section id="all">
        <x-jinguji_ozora.tarot.all :all="$all" />        
    </section>
    <x-slot name="script">
        <x-jinguji_ozora.tarot.script.view_tarot_card />
    </x-slot>
@elseif (isset($spread))
    <section id="form">
        @csrf
        <x-jinguji_ozora.tarot.form />
    </section>
    <section id="result">
        <x-jinguji_ozora.tarot.result :spread="$spread" />
    </section>
    <section id="button">
        <x-jinguji_ozora.tarot.button />
    </section>
    <x-slot name="script">
        <x-jinguji_ozora.tarot.script />
    </x-slot>
@endif
</x-jinguji_ozora.frame.basic>
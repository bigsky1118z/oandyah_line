<x-jinguji_ozora.frame.basic>
    <x-slot name="title">あなたが生まれた日・時間・場所でわかる簡単西洋占星術 [究極の未来へ導く占い師 神宮寺大空]</x-slot>
    <x-slot name="id">astrology</x-slot>
    <x-slot name="head">
    </x-slot>
    <h2>あなたが生まれた日・時間・場所でわかる簡単西洋占星術</h2>
    <section id="form">
        <x-jinguji_ozora.astrology.form :prefectures="$prefectures" :values="$values" />
    </section>
    @if(isset($result) && count($result))
    <section id="result">
            <x-jinguji_ozora.astrology.result :result="$result" />        
        </section>
    @endif
    <section id="button">
        {{-- <x-jinguji_ozora.astrology.button /> --}}
    </section>
    <x-slot name="script">
        <x-jinguji_ozora.astrology.script />
    </x-slot>
</x-jinguji_ozora.frame.basic>
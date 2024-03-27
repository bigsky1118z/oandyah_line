<x-pokemon.frame.basic title="全国図鑑 [ポケモン応援屋]" heading="全国図鑑" id="">
<x-slot name="head">
</x-slot>
<section id="pokemon-list">
    @foreach ($pokemons as $pokemon)
    <dl class="pokemon">
        <dd class="national-pokedex-number"></dd>
        <dd class="name"></dd>
        <dd class="type1"></dd>
        <dd class="type2"></dd>
    </dl>        
    @endforeach    
</section>
<x-slot name="hidden">
</x-slot>
<x-slot name="modal">
</x-slot>
<x-slot name="script">
</x-slot>
</x-pokemon.frame.basic>
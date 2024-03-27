<x-pokemon.frame.basic>
<x-slot name="title">ポケモンリーグ</x-slot>
<x-slot name="id">league</x-slot>
<x-slot name="head">
</x-slot>
<h2>ポケモンリーグ</h2>
<section>
    @foreach ($leagues as $league)
        <dl class="dl-flex-left">
            <dd>{{ $league->id }}</dd>
            <dd><a href="/pokemon/league/{{ $league->id }}">{{ $league->name }}</a></dd>
            <dd>{{ $league->start_date }}</dd>
            <dd>{{ $league->end_date }}</dd>
            <dd><a href="/pokemon/league/{{ $league->id }}/delete">削除</a></dd>
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
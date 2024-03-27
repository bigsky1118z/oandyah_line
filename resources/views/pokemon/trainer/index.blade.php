<x-pokemon.frame.basic>
<x-slot name="title">ポケモントレーナー</x-slot>
<x-slot name="id">trainer</x-slot>
<x-slot name="head">
</x-slot>
<section id="trainer">
    @foreach ($trainers as $trainer)
        <dl class="dl-flex-left">
            <dt style="width: 10em">{{ $trainer->user_name }}</dt>
            <dd style="width: 8em">{{ $trainer->trainer_name }}</dd>
            <dd><a href="/pokemon/trainer/{{ $trainer->id }}/delete">削除</a></dd>
        </dl>
    @endforeach
</section>
<section id="form">
    <x-pokemon.main.form.trainer action="trainer" />
</section>
<x-slot name="hidden">
</x-slot>
<x-slot name="modal">
</x-slot>
<x-slot name="script">
</x-slot>
</x-pokemon.frame.basic>
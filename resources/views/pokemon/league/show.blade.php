<x-pokemon.frame.basic>
<x-slot name="title">{{ $league->name }} [ポケモンリーグ]</x-slot>
<x-slot name="id">league</x-slot>
<x-slot name="head">
</x-slot>
<h2>ポケモンリーグ {{ $league->name }}</h2>
<section id="overview">
    <dl id="dl-overviews">
        <dd>
            <dl class="dl-flex">
                <dt>開催日程</dt>
                <dd>{{ $league->start_date }}</dd>
                @if ($league->start_date != $league->end_date)
                <dd>～</dd>
                <dd>{{ $league->end_date }}</dd>
                @endif
            </dl>
        </dd>
        <dd>        
            <dl class="dl-flex">
                <dt>対戦形式</dt>
                <dd>{{ $league->format }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>ルール</dt>
                <dd>{{ $league->rule }}</dd>
            </dl>
        </dd>
        <dd>
            <dl class="dl-flex">
                <dt>概要</dt>
                <dd>{{ $league->description }}</dd>
            </dl>
        </dd>
    </dl>
</section>
<section id="menu">
    <dl>
        <dd><a href="/pokemon/league/{{ $league->id }}/match" class="button button-move">対戦表</a></dd>
    </dl>
</section>
<section id="trainer">
    <h3>{{ $league->name }}出場トレーナー</h3>
    <dl id="dl-trainers">
        <dt class="dt-trainers-header">
            <dl class="dl-flex">
                <dt class="dt-trainer-id">ID</dt>
                <dt class="dt-trainer-user_name">ユーザー名</dt>
                <dt class="dt-trainer-trainer_name">トレーナー名</dt>
                <dd class="dd-trainer-match">Macth</dd>
                <dd class="dd-trainer-win">Win</dd>
                <dd class="dd-trainer-lose">Lose</dd>
                <dd class="dd-trainer-rate">Rate</dd>
                <dd class="dd-trainer-button">Button</dd>
            </dl>
        </dt>
        @foreach ($league->trainers->sortByDesc(fn($trainer)=>$trainer->win_num())->sortByDesc(fn($trainer)=>$trainer->win_rate()) as $trainer)
            @if ($trainer->trainer->user_name == "Bye" && $trainer->trainer->trainer_name == "Bye")
                @continue
            @else
                <dd class="dd-trainers-body">
                    <dl class="dl-flex">
                        <dt class="dt-trainer-id">{{ $trainer->id }}</dt>
                        <dt class="dt-trainer-user_name">{{ $trainer->trainer->user_name }}</dt>
                        <dt class="dt-trainer-trainer_name">{{ $trainer->trainer->trainer_name }}</dt>
                        <dd class="dd-trainer-match">{{ $trainer->match_num() }}</dd>
                        <dd class="dd-trainer-win">{{ $trainer->win_num() }}</dd>
                        <dd class="dd-trainer-lose">{{ $trainer->lose_num() }}</dd>
                        <dd class="dd-trainer-rate">{{ $trainer->win_rate() >= 0  ? number_format($trainer->win_rate(), 1) . "%" : "-" }}</dd>
                        <dd class="dd-trainer-button"><a class="button button-delete" href="/pokemon/league/{{ $league->id }}/trainer/{{ $trainer->trainer->id }}/delete">削除</a></dd>
                    </dl>
                </dd>
            @endif
        @endforeach
    </dl>
</section>
<section id="form">
    <div id="pokemon-trainer-add">
        <form action="/pokemon/league/{{ $league->id }}/trainer" method="post">
            @csrf
            <dl class="dl-flex flex-center">
                <dd>
                    <select name="trainer_id" required>
                        <option value="">---</option>
                        @foreach ($trainers as $trainer)
                            <option value="{{ $trainer->id }}">{{ $trainer->user_name }}({{ $trainer->trainer_name }})</option>
                        @endforeach
                    </select>
                </dd>
                <dd><button type="submit" class="button button-edit">エントリー</button></dd>
            </dl>
            <dl class="dl-flex flex-center">
                <dd><button type="button" class="button button-create" onclick="document.getElementById('pokemon-trainer-create').classList.remove('hidden')">トレーナー登録</button></dd>
            </dl>
        </form>
    </div>
    <div id="pokemon-trainer-create" @if(old() && (old("user_name") || old("trainer_name"))) @else class="hidden" @endif onclick="this.classList.add('hidden');">
        <div id="pokemon-trainer-create-form" onclick="event.stopPropagation();">
            <h4>新規トレーナー作成</h4>
            <x-pokemon.main.form.trainer action="league/{{ $league->id }}/trainer" :old="old()" />
            <p><button type="button" class="button button-delete" onclick="document.getElementById('pokemon-trainer-create').classList.add('hidden');">閉じる</button></p>
        </div>
    </div>
</section>
<x-slot name="hidden">
</x-slot>
<x-slot name="modal">
</x-slot>
<x-slot name="script">
</x-slot>
</x-pokemon.frame.basic>
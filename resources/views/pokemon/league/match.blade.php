<x-pokemon.frame.basic>
<x-slot name="title">{{ $league->name }}対戦表 [ポケモンリーグ]</x-slot>
<x-slot name="id">league</x-slot>
<x-slot name="head">
</x-slot>
<h2>{{ $league->name }}対戦表</h2>

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
    </dl>
</section>
<section id="menu">
    <dl>
        <dd><a href="/pokemon/league/{{ $league->id }}" class="button button-move">リーグTOP</a></dd>
    </dl>
</section>
<section id="ribon">
    @php
        $ribon  =   $league->get_ribon();
        $column =   "user_name";
    @endphp
    <dl id="dl-ribons">
        <dt class="dt-ribons-header">
            <dl class="dl-flex flex-nowrap">
                <dt class="dt-trainer_name">トレーナー名</dt>
                @foreach ($league->trainers as $trainer)
                    @if ($trainer->trainer->user_name == "Bye" && $trainer->trainer->trainer_name == "Bye")
                        @continue
                    @else
                        <dd class="dd-match-opponent">{{ mb_substr($league->trainer($trainer->id)->trainer[$column], 0, 3, "UTF-8") }}</dd>
                    @endif
                @endforeach
            </dl>
        </dt>
        @foreach ($league->trainers as $trainer)
            <dd class="dd-ribons-body">
                @if ($trainer->trainer->user_name == "Bye" && $trainer->trainer->trainer_name == "Bye")
                    @continue
                @else
                    <dl class="dl-flex flex-nowrap">
                        <dt class="dt-trainer_name">({{ $league->trainer($trainer->id)->id }}){{ $league->trainer($trainer->id)->trainer[$column] }}</dt>
                        @foreach ($league->trainers as $opponent)
                            @php
                                $player1    =   $league->trainer($trainer->id)->trainer;
                                $player2    =   $league->trainer($opponent->id)->trainer;
                                $result     =   isset($ribon[$player1->id][$player2->id]) ? $ribon[$player1->id][$player2->id] : null;
                            @endphp
                            @if ($opponent->trainer->user_name == "Bye" && $opponent->trainer->trainer_name == "Bye")
                                @continue
                            @elseif ($player1 == $player2 || !$result)
                                <dd class="dd-match-result">-</dd>
                            @elseif ($result == $player1->id || $result == $player2->id)
                                <dd class="dd-match-result">{{ $result == $player1->id ? "〇" : "×" }}</dd>
                            @else
                                <dd class="dd-match-result">{{ $result }}</dd>
                            @endif
                        @endforeach
                    </dl>
                @endif
            </dd>
        @endforeach
    </dl>
</section>
<section id="match">
    @php
        $column =   "user_name";
    @endphp
    <dl id="dl-matches">
        @foreach ($league->matchs->groupBy("round") as $round_index => $group)
            <dt>第{{ $round_index + 1 }}試合</dt>
            @foreach ($group as $group_index => $match)
                <dd>
                    <dl class="dl-flex flex-center dl-match">
                        <dd>
                            <dl class="dl-flex flex-nowrap dl-match-info">
                                <dd>{{ "ABCDEFGHIJKLMNOPQRSTUVWXYZ"[$group_index] }}</dd>
                                <dd>{{$match->code }}</dd>
                                <dd>
                                    <label for="match-{{ $match->id }}-0">clear</label>
                                    <input type="radio" name="{{ $match->id }}" id="match-{{ $match->id }}-0" value="" onchange="match_result(this);" @checked(!$match->winner) class="hidden">
                                </dd>
                            </dl>
                        </dd>
                        <dd>
                            <dl class="dl-flex flex-nowrap dl-match-input">
                                <dd><input type="radio" name="{{ $match->id }}" id="match-{{ $match->id }}-{{ $match->player1->trainer->id }}" value="{{ $match->player1->id }}" onchange="match_result(this);" @checked($match->winner && $match->player1->trainer->id == $match->winner->trainer->id)></dd>
                                <dt class="dt-trainer_name"><label for="match-{{ $match->id }}-{{ $match->player1->trainer->id }}">{{ $match->player1->trainer[$column] }}</label></dt>
                                <dd>vs</dd>
                                <dt class="dt-trainer_name"><label for="match-{{ $match->id }}-{{ $match->player2->trainer->id }}">{{ $match->player2->trainer[$column] }}</label></dt>
                                <dd><input type="radio" name="{{ $match->id }}" id="match-{{ $match->id }}-{{ $match->player2->trainer->id }}" value="{{ $match->player2->id }}" onchange="match_result(this);" @checked($match->winner && $match->player2->trainer->id == $match->winner->trainer->id)></dd>
                            </dl>
                        </dd>
                    </dl>
                </dd>
            @endforeach
        @endforeach
    </dl>
</section>
<x-slot name="hidden">
</x-slot>
<x-slot name="modal">
</x-slot>
<x-slot name="script">
    <script>
        const token =   document.querySelector("meta[name='csrf-token']").getAttribute("content");

        function match_result(radio){
            const form      =   new FormData();
                form.append("_token", token);
                form.append("name", radio.name);
                form.append("value", radio.value);
            const options   =   {
                "method"    :   "post",
                "body"      :   form,
            };
            fetch("/pokemon/league/{{ $league->id }}/match", options).then(response => response.ok ? location.reload() : null);
        }
    </script>
</x-slot>
</x-pokemon.frame.basic>
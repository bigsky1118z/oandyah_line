<x-pokemon.frame.basic>
<x-slot name="title">ポケモンリーグ企画</x-slot>
<x-slot name="id">league</x-slot>

<x-slot name="head">
</x-slot>
<section>
    <form action="/pokemon/league" method="post">
        @csrf
        <dl class="dl-flex-left">
            <dt>name</dt>
            <dd><input type="text" name="name" required></dd>
        </dl>
        <dl class="dl-flex-left">
            <dt>start_date</dt>
            <dd><input type="date" name="start_date" required></dd>
        </dl>
        <dl class="dl-flex-left">
            <dt>end_date</dt>
            <dd><input type="date" name="end_date" required></dd>
        </dl>
        <dl class="dl-flex-left">
            <dt>match_num</dt>
            <dd>
                <select name="match_num">
                    <option value="">無制限</option>
                    @foreach (range(1,10) as $number)
                        <option value="{{ $number }}">{{ $number }}回</option>                        
                    @endforeach
                </select>
            </dd>
        </dl>
        <dl class="dl-flex-left">
            <dt>button</dt>
            <dd><button type="submit">保存</button></dd>
        </dl>
    </form>
</section>
<x-slot name="hidden">
</x-slot>
<x-slot name="modal">
</x-slot>
<x-slot name="script">
</x-slot>
</x-pokemon.frame.basic>
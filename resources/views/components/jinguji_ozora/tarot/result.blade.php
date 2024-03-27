<div id="tarot-cross">
    <div id="tarot-result-spread" class="tarot-result-spread-{{ $spread['name'] }}">
        @foreach (range(1, (int)$spread['count']) as $number)
            <dl id="tarot-result-{{ $number + 6 }}" class="tarot-card" data-tarot-card="">
                <dt class="tarot-card-image"></dt>
                <dd class="tarot-card-name hidden"></dd>
                <dd class="tarot-card-number hidden"></dd>
            </dl>            
        @endforeach
    </div>
    <div id="tarot-result-add" class="hidden">
        <dl id="tarot-result-78" class="tarot-card" data-tarot-card="bottom" onclick="open_tarot_card('bottom');">
            <dt class="tarot-card-image"><img src="https://oandyah.com/storage/image/tarot/Z_GOLD_BOTTOM.png"></dt>
            <dd class="tarot-card-name hidden"></dd>
            <dd class="tarot-card-number hidden"></dd>
        </dl>
        <dl id="tarot-result-0" class="tarot-card" onclick="open_tarot_card('add');">
            <dt class="tarot-card-image"><img src="https://oandyah.com/storage/image/tarot/Z_GOLD.png"></dt>
            <dd class="tarot-card-name hidden"></dd>
            <dd class="tarot-card-number hidden"></dd>
        </dl>
    </div>
</div>
<div class="for-download hidden">
    <p style="font-size: 10px ;text-align: right;">produced by https://oandyah.com/jinguji_ozora</p>
</div>
<div id="tarot-card-viewer" class="hidden" onclick="this.classList.add('hidden');">
    <dl class="tarot-card">
        <dt class="tarot-card-image"></dt>
        <dd class="tarot-card-name"></dd>
        <dd class="tarot-card-number"></dd>
    </dl>
</div>
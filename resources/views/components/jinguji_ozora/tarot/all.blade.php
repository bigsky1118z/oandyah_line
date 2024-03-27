<div id="tarot-cross">
    <div id="tarot-all">
        @foreach ($all as $tarot)
            <dl id="tarot-all-{{ $tarot->id }}" class="tarot-card" data-tarot-card="{{ $tarot->id }}" onclick="view_tarot_card(this);">
                <dt class="tarot-card-image"><img src="{{ $tarot->image_url }}" alt=""></dt>
                <dd class="tarot-card-name">{{ $tarot->name_jp }}</dd>
                <dd class="tarot-card-number">{{ $tarot->number_jp }}</dd>
            </dl>            
        @endforeach
    </div>
</div>
<div id="tarot-card-viewer" class="hidden" onclick="this.classList.add('hidden');">
    <dl class="tarot-card">
        <dt class="tarot-card-image"></dt>
        <dd class="tarot-card-name"></dd>
        <dd class="tarot-card-number"></dd>
    </dl>
</div>
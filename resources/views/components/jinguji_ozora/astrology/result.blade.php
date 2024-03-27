@php
    use App\Models\JingujiOzora\JingujiOzora;
    $planets    =   JingujiOzora::$planets;
    $signs      =   JingujiOzora::$signs;
@endphp
<h3>結果</h3>
<dl id="dl-results">
    <dd>
        <dl id="result-planet-signs">
            <dt>惑星星座</dt>
            <dd>
                @foreach ($result["planet_signs"] as $planet_sign_key => $planet_sign)
                    @php
                        $planet =   $planets[$planet_sign["planet"]];
                        $sign   =   $signs[$planet_sign["sign"]];
                    @endphp
                    <dl class="planet-sign">
                        <dt class="result-planet-sign-planet">あなたの{{ $planet["title"] }}星座</dt>
                        <dd class="result-planet-sign-sign">{{ $sign["title_kana"] }}</dd>
                        <dd class="result-planet-sign-degree">{{ (int)$planet_sign["degree"] - (int) $sign["degree"] }}°</dd>
                    </dl>
                @endforeach
            </dd>
        </dl>
    </dd>
    <dd class="for-download hidden">
        <dl>
            <dd style="font-size: 10px ;text-align: right;">produced by https://oandyah.com/jinguji_ozora</dd>
        </dl>
    </dd>
</dl>

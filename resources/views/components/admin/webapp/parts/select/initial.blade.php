@php
    $initials50   =   array(
        array("あ"=>"ア|ァ","か"=>"カ|ガ","さ"=>"サ|ザ","た"=>"タ|ダ","な"=>"ナ","は"=>"ハ|バ|パ","ま"=>"マ","や"=>"ヤ|ャ","ら"=>"ラ","わ"=>"ワ|ヮ",),
        array("い"=>"イ|ィ","き"=>"キ|ギ","し"=>"シ|ジ","ち"=>"チ|ヂ","に"=>"ニ","ひ"=>"ヒ|ビ|ピ","み"=>"ミ",""=>"","り"=>"リ",""=>"",),
        array("う"=>"ウ|ゥ|ヴ","く"=>"ク|グ","す"=>"ス|ズ","つ"=>"ツ|ヅ|ッ","ぬ"=>"ヌ","ふ"=>"フ|ブ|プ","む"=>"ム","ゆ"=>"ユ|ュ","る"=>"ル","を"=>"ヲ|オ|ォ",),
        array("え"=>"エ|ェ","け"=>"ケ|ゲ","せ"=>"セ|ゼ","て"=>"テ|デ","ね"=>"ネ","へ"=>"ヘ|ベ|ペ","め"=>"メ",""=>"","れ"=>"レ",""=>"",),
        array("お"=>"オ|ォ","こ"=>"コ|ゴ","そ"=>"ソ|ゾ","と"=>"ト|ド","の"=>"ノ","ほ"=>"ホ|ボ|ポ","も"=>"モ","よ"=>"ヨ|ョ","ろ"=>"ロ","ん"=>"ン",),
    );
@endphp
<table style="width: 26em; margin:0 auto;">
    <thead>
        <tr>
            <th colspan="8">50音索引</th>
            <td colspan="2">
                <label style="border:1px solid rgba(0,0,0,0.5); padding: 0 1em;"><input type="radio" name="initial" value="" style="display:none;">clear</label>
            </td>
        </tr>
    </thead>
    <tbody>
        @foreach ($initials50 as $index1 => $initials)
        @php $index2 = 0; @endphp
        <tr>
            @foreach ($initials as $key => $initial)
            <td>
                @if ($initial)
                <label for="initial-{{ $index1 }}-{{ $index2 }}"><input type="radio" id="initial-{{ $index1 }}-{{ $index2 }}" name="initial" value="{{ $initial }}" @if ($value == $initial) checked @endif>{{ $key }}</label>
                @endif
            @php $index2++; @endphp
            </td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
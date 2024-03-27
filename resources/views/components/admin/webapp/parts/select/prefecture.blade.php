@props(array(
    "name"          =>  "pref",
    "id"            =>  null,
    "value"         =>  null,
    "prefectures"   =>  array(
        "大阪府","奈良県","和歌山県","京都府","兵庫県","三重県","滋賀県","東京都","神奈川県","埼玉県","千葉県","茨城県","栃木県","群馬県","長野県","岐阜県","静岡県","愛知県","北海道","青森県","岩手県","宮城県","秋田県","山形県","福島県","新潟県","富山県","石川県","福井県","山梨県","鳥取県","島根県","岡山県","広島県","山口県","徳島県","香川県","愛媛県","高知県","福岡県","佐賀県","長崎県","熊本県","大分県","宮崎県","鹿児島県","沖縄県",
    ),
))
<select name="{{ $name }}" @if ($id) id="{{ $id }}" @endif>
    <option value="">---</option>
    @foreach ($prefectures as $prefecture)
        <option value="{{ $prefecture }}" @if ($value == $prefecture) selected @endif>{{ $prefecture }}</option>
    @endforeach
</select>
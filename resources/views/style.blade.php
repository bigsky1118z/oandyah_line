@charset "utf-8";

@foreach (array("デフォルト設定" => $defaults,"カスタマイズ設定"=>$customizes) as $key => $grouped_styles)
/* {{ $key }} */

@foreach ($grouped_styles as $selector => $styles)
    {{ $selector }} {
@foreach($styles as $style)
        {{ $style->property }} : {{ $style->value }};
@endforeach
    }
@endforeach
@endforeach
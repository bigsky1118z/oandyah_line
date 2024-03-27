<x-admin.api.line.frame.basic title="リッチメニュー" heading="リッチメニュー" :channel="$channel">
<x-slot name="head">
    <style>
        .chatBarText{
            text-align: center;
            margin: 0;
            padding: 10px;
            background-color: #4CC764;
        }
        .area{
            position: absolute;
            text-align: center;
            opacity: 0.3;
        }
        .area:hover{
            opacity: 0.5;
            cursor: pointer;
            font-weight: bold;
        }
        
    </style>
</x-slot>
<h3>{{ isset($richmenu["name"]) ? $richmenu["name"] : null }}</h3>
<dl class="dl-felx-left">
    <dt>横</dt>
    <dd>{{ isset($richmenu["size"]["width"]) ? $richmenu["size"]["width"] . "px" : null }}</dd>
</dl>
<dl class="dl-felx-left">
    <dt>縦</dt>
    <dd>{{ isset($richmenu["size"]["height"]) ? $richmenu["size"]["height"] . "px" : null }}</dd>
</dl>
<div style="width: 500px; position: relative;">
@isset($richmenu_image_url)
    <img src="{{ $richmenu_image_url }}" width="100%" style="vertical-align: bottom;">
@endisset
@isset($richmenu["areas"])
    @foreach ($richmenu["areas"] as $area_index => $area)
    <div class="area" style="background-color: #FFFFFF; left:{{ $area["bounds"]["x"]/5 }}px; top:{{ $area["bounds"]["y"]/5 }}px; width:{{ $area["bounds"]["width"]/5 }}px; height:{{ $area["bounds"]["height"]/5 }}px; line-height:{{ $area["bounds"]["height"]/5 }}px;">{{ $area_index + 1 }}</div>
    @endforeach
@endisset
    <p class="chatBarText">{{ isset($richmenu["chatBarText"]) ? $richmenu["chatBarText"] : null }}</p>
</div>
<table>
    @isset($richmenu["areas"])
        @foreach ($richmenu["areas"] as $area_index => $area)
        <tr>
            <td>{{ $area_index + 1 }}</td>
            <td>{{ isset($area["action"]["label"]) ? $area["action"]["label"] : null }}</td>
            <td>{{ isset($area["bounds"]["x"]) ? $area["bounds"]["x"] : null }}</td>
            <td>{{ isset($area["bounds"]["y"]) ? $area["bounds"]["y"] : null }}</td>
            <td>{{ isset($area["bounds"]["width"]) ? $area["bounds"]["width"] : null }}</td>
            <td>{{ isset($area["bounds"]["height"]) ? $area["bounds"]["height"] : null }}</td>
            <td>{{ isset($area["action"]["type"]) ? $area["action"]["type"] : null }}</td>
            <td>{{ isset($area["action"]["data"]) ? $area["action"]["data"] : null }}</td>
        </tr>
        @endforeach
    @endisset
    
</table>    
</x-admin.api.line.frame.basic>
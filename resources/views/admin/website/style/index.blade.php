<x-admin.website.frame.basic title="Style - Setting" heading="スタイル編集">
    <x-slot name="head">
        <style>
            input[type="color"] {
                width: 80px;
            }
            input[type="number"] {
                width: 40px;
            }
            form table th:nth-child(1) {
                width: 180px;
            }
        </style>
    </x-slot>
    <form action="/admin/website/style" method="post">
        @csrf
        <h3>基本設定</h3>
        @foreach ($selectors as $section => $selectors)
            <h4>{{ $section }}</h4>
            <table>
                <thead>
                    <tr>
                        <th>セレクタ</th>
                        <th>文字色</th>
                        <th>背景色</th>
                        <th>文字サイズ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($selectors as $selector => $title)
                    @php
                        if(isset($default_styles[$selector])){
                            $style  =   $default_styles[$selector];
                        }else {
                            $style  =   array();
                        }
                    @endphp
                    <tr>
                        <td style="display:flex; flex-direction:column;">
                            <span>{{ $title }}</span>
                            {{-- <span style="font-size:10px;">{{ $selector }}</span> --}}
                        </td>
                        <td>
                            @if (!empty($style) && in_array("color",array_column($style->toArray(),"property")))
                            <input type="color" name="styles[{{ $selector }}][color]" value="{{ $style[array_search("color",array_column($style->toArray(),"property"))]->value }}">
                            @else
                            <input type="color" name="styles[{{ $selector }}][color]" value="#000000">
                            @endif
                        </td>
                        <td>
                            @if ($selector=="header span#header-logo-text" || $selector=="a")
                            @elseif (!empty($style) && in_array("background-color",array_column($style->toArray(),"property")))
                            <input type="color" name="styles[{{ $selector }}][background-color]" value="{{ $style[array_search("background-color",array_column($style->toArray(),"property"))]->value }}">
                            @else
                            <input type="color" name="styles[{{ $selector }}][background-color]" value="#FFFFFF">
                            @endif
                        </td>
                        <td>
                            @if (!empty($style) && in_array("font-size",array_column($style->toArray(),"property")))
                            <input type="number" name="styles[{{ $selector }}][font-size]" value="{{ $style[array_search("font-size",array_column($style->toArray(),"property"))]->value }}">
                            @else
                            <input type="number" name="styles[{{ $selector }}][font-size]">
                            @endif
                            <span>px</span>
                        </td>
                    </tr>                    
                    @endforeach
                </tbody>
            </table>
        @endforeach
        <h3>カスタマイズ</h3>
        <textarea name="styles[customize][customize]" cols="80" rows="30">{{ $customize_style->value }}</textarea>

        <p><button type="submit" onclick="window.onbeforeunload=null;">save</button></p>
    </form>
    <x-slot name="hidden">
    </x-slot>
    <x-slot name="script">
    </x-slot>
</x-admin.website.frame.basic>
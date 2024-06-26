<x-frame.web>
    <x-slot name="id">user-app-richmenu-show</x-slot>
    <x-slot name="title">リッチメニュー詳細</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head">
        <style>
            div#richmenu-preview {
                position: relative;
                background-color: rgba(0, 0, 0, 0.5);
            }
            div#richmenu-preview > img{
                position: absolute;
                top: 0;
                left: 0;
            }
            
            div.richmenu-preview-area{
                position: absolute;
                text-align: center;
                border: 1px solid #000000;
                background-color: rgba(255, 255, 255, 0.50);
                cursor: pointer;
            }
            div.richmenu-preview-area:hover {
                background-color: rgba(255, 255, 255, 0.75);
            }
            /* @for ($i=0; $i<20; $i++)
                div#richmenu-preview-area-{{ $i }}{
                    background-color: rgba({{ rand(0,255) }}, {{ rand(0,255) }}, {{ rand(0,255) }}, 0.5);
                }                
            @endfor */

        </style>
    </x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name.'/app') }}">アプリ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id) }}">{{ $app->display_name ?? $app->client_id }}</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/richmenu') }}">リッチメニュー一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/richmenu/'.$richmenu->id) }}">{{ $richmenu->name }}</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name }}</h2>
        <section>
            <h3>リッチメニュー詳細</h3>
            <table>
                <tbody>
                    <tr>
                        <th>名前</th>
                        <td>{{ $richmenu->name ?? null }}</td>
                    </tr>
                    <tr>
                        <th>サイズ</th>
                        <td>横{{ $richmenu->size["width"] ?? null }}×縦{{ $richmenu->size["height"] ?? null }}</td>
                    </tr>
                    <tr>
                        <th>メニューに表示されるテキスト</th>
                        <td>{{ $richmenu->chat_bar_text ?? null }}</td>
                    </tr>
                    <tr>
                        <th>デフォルト表示</th>
                        <td>{{ $richmenu->selected ? "表示" : "非表示" }}</td>
                    </tr>
                </tbody>
            </table>
            <table>
                <thead>
                    <tr>
                        <th colspan="2">開始位置</th>
                        <th colspan="2">大きさ</th>
                        <th>動作</th>
                    </tr>
                    <tr>
                        <th>X軸</th>
                        <th>Y軸</th>
                        <th>横</th>
                        <th>縦</th>
                        <th>アクション</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 20; $i++)
                        <tr>
                            <td>{{ $richmenu->areas[$i]["bounds"]["x"] ?? null }}</td>
                            <td>{{ $richmenu->areas[$i]["bounds"]["y"] ?? null }}</td>
                            <td>{{ $richmenu->areas[$i]["bounds"]["width"] ?? null }}</td>
                            <td>{{ $richmenu->areas[$i]["bounds"]["height"] ?? null }}</td>
                            <td>
                                <ul>
                                    @foreach (($richmenu->areas[$i]["action"] ?? array()) as $key => $value)
                                        <li>
                                            <dl style="display: flex;">
                                                <dt style="width: 100px;">{{ $key }}</dt>
                                                <dd>{{ $value }}</dd>
                                            </dl>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            <div id="richmenu-preview" style="width:{{ ($richmenu->size["width"]/2) ?? 0 }}px; height:{{ ($richmenu->size["height"]/2) ?? 0 }}px;">
                <img id="richmenu-preview-content" src="{{ asset($richmenu->get_richmenu_content_url()) }}">
                @foreach ( ($richmenu->areas ?? array()) as $index => $areas)
                    <div class="richmenu-preview-area" id="richmenu-preview-area-{{ $index }}" style="width:{{ ($areas["bounds"]["width"]/2) ?? 0 }}px; height:{{ ($areas["bounds"]["height"]/2) ?? 0 }}px; top:{{ ($areas["bounds"]["x"]/2) ?? 0 }}px; left:{{ ($areas["bounds"]["y"]/2) ?? 0 }}px;">{{ $areas["action"]["label"] ?? null }}</div>                
                @endforeach
            </div>                
        </section>
    </x-slot>
    <x-slot name="hidden">
    </x-slot>
    <x-slot name="footer">
    </x-slot>
    <x-slot name="script">
        <script>
            window.onload = resize_img();
            function resize_img(){
                const img               =   document.getElementById("richmenu-preview-content");
                img.onload  = function(){
                    const original_width    =   img.naturalWidth;
                    const original_height   =   img.naturalHeight;
                    img.style.width         =   (original_width/2) + "px";
                    img.style.height        =   (original_height/2) + "px";
                }
            }
        </script>
    </x-slot>
</x-frame.web>
<x-frame.web>
    <x-slot name="id">user-app-richmenu-create</x-slot>
    <x-slot name="title">リッチメニュー作成</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head">
        <style>
            div#richmenu-preview{
                position: relative;
                min-height: 125px;
            }
            div#richmenu-preview > img{
                position: absolute;
                top: 0;
                left: 0;
                display: block;
                z-index: 10;
            }
            div#richmenu-preview > div#richmenu-preview-alternative{
                position: absolute;
                top: 0;
                left: 0;
                background-color: rgba(0, 0, 0, 0.2);
                display: block;
                z-index: 100;
            }
            div#richmenu-preview > div.richmenu-preview-area{
                position: absolute;
                text-align: center;
                border: 1px solid #000000;
                background-color: rgba(255, 255, 255, 0.25);
                cursor: pointer;
                z-index: 1000;
            }
            div#richmenu-preview > div.richmenu-preview-area:hover {
                background-color: rgba(255, 255, 255, 0.75);
            }

        </style>
    </x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name.'/app') }}">アプリ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id) }}">{{ $app->display_name ?? $app->client_id }}</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/richmenu') }}">リッチメニュー一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/richmenu/create') }}">リッチメニュー作成</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name }}</h2>
        <section>
            <h3>リッチメニュー作成</h3>
            <form action="{{ asset($user->name.'/app/'.$app->client_id.'/richmenu'.($richmenu->id ? '/'. $richmenu->id : null)) }}" method="post" enctype="multipart/form-data">
                @csrf
                <table>
                    <tbody>
                        <tr>
                            <th>画像アップロード</th>
                            <td>
                                <input type="file" name="richmenu_content" accept="image/png,image/jpeg" onchange="richmenu_preview_image(this);" class="hidden" style="display: none;">
                                <button type="button" onclick="document.querySelector('input[name=richmenu_content]').click();">画像選択</button>
                                <p id="richmenu-content-message"></p>
                            </td>
                            <td><img src="" alt=""></td>
                        </tr>
                        <tr>
                            <th>サイズ</th>
                            <td>
                                <dl style="display: flex;">
                                    <dd>横<input type="number" name="size[width]" min="800" max="2500"  value="{{ $richmenu->size["width"] ?? null }}" readonly></dd>
                                    <dd>縦<input type="number" name="size[height]" min="250" max="1686"  value="{{ $richmenu->size["height"] ?? null }}" readonly></dd>
                                </dl>
                            </td>
                        </tr>
                        <tr>
                            <th>名前</th>
                            <td><input type="text" name="name" value="{{ $richmenu->name ?? null }}" required></td>
                        </tr>
                        <tr>
                            <th>メニューに表示されるテキスト</th>
                            <td><input type="text" name="chat_bar_text" value="{{ $richmenu->chat_bar_text ?? null }}" required></td>
                        </tr>
                        <tr>
                            <th>デフォルト表示</th>
                            <td><input type="checkbox" name="selected" @checked($richmenu->selected)></td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">開始位置</th>
                            <th colspan="2">大きさ</th>
                            <th colspan="3">動作</th>
                        </tr>
                        <tr>
                            <th>X軸</th>
                            <th>Y軸</th>
                            <th>横</th>
                            <th>縦</th>
                            <th>ラベル</th>
                            <th>タイプ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 20; $i++)
                            <tr>
                                <td><input type="number"    name="areas[{{ $i }}][bounds][x]"       value="{{ $richmenu->areas[$i]["bounds"]["x"] ?? null }}"       min="0" max="2500"  data-index="{{ $i }}" onchange="richmenu_preview_area(this);"></td>
                                <td><input type="number"    name="areas[{{ $i }}][bounds][y]"       value="{{ $richmenu->areas[$i]["bounds"]["y"] ?? null }}"       min="0" max="2500"  data-index="{{ $i }}" onchange="richmenu_preview_area(this);"></td>
                                <td><input type="number"    name="areas[{{ $i }}][bounds][width]"   value="{{ $richmenu->areas[$i]["bounds"]["width"] ?? null }}"   min="1" max="2500"  data-index="{{ $i }}" onchange="richmenu_preview_area(this);"></td>
                                <td><input type="number"    name="areas[{{ $i }}][bounds][height]"  value="{{ $richmenu->areas[$i]["bounds"]["height"] ?? null }}"  min="1" max="2500"  data-index="{{ $i }}" onchange="richmenu_preview_area(this);"></td>
                                <td><input type="text"      name="areas[{{ $i }}][action][label]"   value="{{ $richmenu->areas[$i]["action"]["label"] ?? null }}"                       data-index="{{ $i }}" onchange="richmenu_preview_area(this);"></td>
                                <td>
                                    <select name="areas[{{ $i }}][action][type]" data-index="{{ $i }}" onchange="select_action_type(this);">
                                        <option value="">---</option>
                                        @foreach ($types as $type => $type_title)
                                            <option value="{{ $type }}" @selected($type == ($richmenu->areas[$i]["action"]["type"] ?? null))>{{ $type_title }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td id="areas-{{ $i }}-action-option">
                                    @switch($richmenu->areas[$i]["action"]["type"] ?? null)
                                        @case("postback")       <x-web.richmenus.create.postback        id="" :index="$i" :action="($richmenu->areas[$i]['action'] ?? array())" />  @break
                                        @case("message")        <x-web.richmenus.create.message         id="" :index="$i" :action="($richmenu->areas[$i]['action'] ?? array())" />  @break
                                        @case("uri")            <x-web.richmenus.create.uri             id="" :index="$i" :action="($richmenu->areas[$i]['action'] ?? array())" />  @break
                                        @case("datetimepicker") <x-web.richmenus.create.datetimepicker  id="" :index="$i" :action="($richmenu->areas[$i]['action'] ?? array())" />  @break
                                        @case("richmenuswitch") <x-web.richmenus.create.richmenuswitch  id="" :index="$i" :action="($richmenu->areas[$i]['action'] ?? array())" />  @break
                                        @case("clipboard")      <x-web.richmenus.create.clipboard       id="" :index="$i" :action="($richmenu->areas[$i]['action'] ?? array())" />  @break
                                    @endswitch
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
                <p><button type="submit">保存</button></p>
                <section>
                    <h3>プレビュー</h3>
                    <div id="richmenu-preview">
                        <div id="richmenu-preview-alternative"></div>
                        <img id="richmenu-preview-content" src="{{ asset($richmenu->get_richmenu_content_url()) ?? null }}">
                        @for ($i = 0; $i < 20; $i++)
                            <div class="richmenu-preview-area" id="richmenu-preview-area-{{ $i }}"></div>                    
                        @endfor                    
                    </div>
                </section>
            </form>
        </section>
    </x-slot>
    <x-slot name="hidden">
        <x-web.richmenus.create.postback        id="sumple-action-type-postback"        index="{sumple}" :action="array()" />
        <x-web.richmenus.create.message         id="sumple-action-type-message"         index="{sumple}" :action="array()" />
        <x-web.richmenus.create.uri             id="sumple-action-type-uri"             index="{sumple}" :action="array()" />
        <x-web.richmenus.create.datetimepicker  id="sumple-action-type-datetimepicker"  index="{sumple}" :action="array()" />
        <x-web.richmenus.create.richmenuswitch  id="sumple-action-type-richmenuswitch"  index="{sumple}" :action="array()" />
        <x-web.richmenus.create.clipboard       id="sumple-action-type-clipboard"       index="{sumple}" :action="array()" />
    </x-slot>
    <x-slot name="footer">
    </x-slot>
    <x-slot name="script">
        <script>
            run();
            function run(){
                for(let i=0; i<20; i++){
                    richmenu_preview_area(document.querySelector(`input[name='areas[${i}][bounds][x]']`));
                }
                resize_richmenu_preview_image();
            }

            function resize_richmenu_preview_image(){
                const img   =   document.getElementById("richmenu-preview-content");
                img.onload  =   function(){
                    const original_width    =   img.naturalWidth;
                    const original_height   =   img.naturalHeight;
                    img.style.width         =   (original_width/2)+"px";
                    img.style.height        =   (original_height/2)+"px";
                }
            }
            function richmenu_preview_image(input){
                const img               =   document.getElementById("richmenu-preview-content");
                const message           =   document.getElementById("richmenu-content-message");
                const files             =   input.files;
                const file              =   files[0] ?? null;
                const error             =   new Array();
                const previous_src      =   img.src;
                const previous_width    =   img.naturalWidth;
                const previous_height   =   img.naturalHeight;
                if(file){
                    const size  =   file["size"] ?? null;
                    if(size > 1024 * 1024){
                        error.push("1MB以下のファイルを選択してください");
                    }
                    const reader    =   new FileReader();
                    reader.onload   =   function(e){
                        img.src     =   e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
                img.onload  =   function(){
                    const width             =   input.closest("form").querySelector("input[name='size[width]']");
                    const height            =   input.closest("form").querySelector("input[name='size[height]']");
                    const original_width    =   img.naturalWidth;
                    const original_height   =   img.naturalHeight;
                    original_width  > 2500                  ?   error.push("画像の幅の最大は2500pxです") : null;
                    original_width  <  800                  ?   error.push("画像の幅の最小は800pxです")  : null;
                    original_height <  250                  ?   error.push("画像の高さの最小は250pxです")  : null;
                    original_width/original_height < 1.45   ?   error.push("画像の「幅/高さ」のアスペクト比は1.45以上にしてください")  : null;
                    if(error.length){
                        img.src             =   previous_src;
                        width.value         =   previous_width;
                        height.value        =   previous_height;
                        img.style.width     =   previous_width;
                        img.style.height    =   previous_height;
                        message.innerHTML   =   error.join("<br>");
                        return false;
                    } else {
                        width.value         =   original_width;
                        height.value        =   original_height;
                        img.style.width     =   (original_width/2) + "px";
                        img.style.height    =   (original_height/2) + "px";
                        message.innerHTML   =   "";
                    }
                    resize_richmenu_preview();
                };
            }
            function resize_richmenu_preview(){
                const preview                       =   document.querySelector("div#richmenu-preview");
                const preview_alternative           =   document.querySelector("div#richmenu-preview-alternative");
                const width                         =   document.querySelector("input[name='size[width]']");
                const height                        =   document.querySelector("input[name='size[height]']");
                preview.style.height                =   (height.value/2) + "px";
                preview_alternative.style.width     =   (width.value/2) + "px";
                preview_alternative.style.height    =   (height.value/2) + "px";
            }

            function richmenu_preview_area(input){
                const index         =   input.getAttribute("data-index");
                const area          =   input.closest("form").querySelector("div#richmenu-preview-area-"+index);
                const x             =   input.closest("form").querySelector("input[name='areas["+index+"][bounds][x]']");
                const y             =   input.closest("form").querySelector("input[name='areas["+index+"][bounds][y]']");
                const width         =   input.closest("form").querySelector("input[name='areas["+index+"][bounds][width]']");
                const height        =   input.closest("form").querySelector("input[name='areas["+index+"][bounds][height]']");
                const label         =   input.closest("form").querySelector("input[name='areas["+index+"][action][label]']");
                area.style.top      =   (x.value/2) + "px";
                area.style.left     =   (y.value/2) + "px";
                area.style.width    =   (width.value/2) + "px";
                area.style.height   =   (height.value/2) + "px";
                area.textContent    =   label.value;
            }

            function select_action_type(select){
                const value         =   select.value;
                const index         =   select.getAttribute("data-index");
                const target        =   document.getElementById("areas-"+index+"-action-option");
                target.innerHTML    = '';
                const sumple        =   document.getElementById("sumple-action-type-" + value);
                if(sumple){
                    const div   =   sumple.cloneNode(true);
                    div.removeAttribute("id");
                    div.querySelectorAll("input,select,textarea").forEach(node=>{
                        const name  =   node.name;
                        node.name   =   name.replace("[{sumple}]","["+index+"]");
                    });
                    target.appendChild(div);
                }

            }
        </script>
    </x-slot>
</x-frame.web>
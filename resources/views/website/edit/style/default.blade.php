<x-website.frame.edit title="スタイル一覧">
<form id="style-form" action="/edit/style" method="post">
    @csrf
    <h2>デフォルト一覧</h2>
    <p><a href="/edit/style/customize" class="button button-create">カスタマイズ一覧</a></p>
    <section>
        <h3>背景色設定</h3>
        <dl class="dl-flex-left">
            <dt class="style-heading">セレクター</dt>
            <dt class="style-heading">背景色</dt>
        </dl>
        @foreach (array("body","header","main","footer") as $selector)
            <dl class="dl-flex-left">
                <dd class="style-heading">{{ $selector }}</dd>
                @php
                    $style  =   $styles[$selector]->where("property","background-color")->first();
                @endphp
                <dd class="style-heading"><input type="text" data-id="{{ $style->id }}" data-previous="{{ $style->value }}" value="{{ $style->value }}"></dd>                
            </dl>            
        @endforeach
        <p><button type="button" class="button button-edit" onclick="edit();">編集</button></p>
    </section>
    <section>
        <h3>ヘディング設定</h3>
        <dl class="dl-flex-left">
            <dt class="style-heading">セレクター</dt>
            <dt class="style-heading">文字サイズ</dt>
            <dt class="style-heading">文字色</dt>
            <dt class="style-heading">背景色</dt>
        </dl>
        @foreach (array("h1","h2","h3","h4","h5","h6","p","li") as $selector)
            <dl class="dl-flex-left">
                <dd class="style-heading">{{ $selector }}</dd>
                @foreach (array("font-size","color","background-color") as $property)
                    @php
                        $style  =   $styles[$selector]->where("property",$property)->first();
                    @endphp
                    <dd class="style-heading"><input type="text" data-id="{{ $style->id }}" data-previous="{{ $style->value }}" value="{{ $style->value }}"></dd>                
                @endforeach
            </dl>            
        @endforeach
        <p><button type="button" class="button button-edit" onclick="edit();">編集</button></p>
   </section>
   <section>
        <h3>ディスプレイ設定</h3>
        <dl class="dl-flex-left">
            <dt class="style-selector">セレクタ</dt>
            <dt class="style-property">プロパティ</dt>
            <dt class="style-value">値</dt>
            <dt class="style-button"></dt>
        </dl>
        @php
            $style  =   $styles["a"]->where("property","color")->first();
        @endphp
        <dl class="dl-flex-left">
            <dt class="style-selector">aタグ</dt>
            <dd class="style-property">文字色</dd>
            <dd class="style-value"><input type="text" data-id="{{ $style->id }}" data-previous="{{ $style->value }}" value="{{ $style->value }}"></dd>
        </dl>
        @php
            $style  =   $styles["ul"]->where("property","list-style")->first();
        @endphp
        <dl class="dl-flex-left">
            <dt class="style-selector">ulタグ</dt>
            <dd class="style-property">リストスタイル</dd>
            <dd class="style-value"><input type="text" data-id="{{ $style->id }}" data-previous="{{ $style->value }}" value="{{ $style->value }}"></dd>
        </dl>
        <p><button type="button" class="button button-edit" onclick="edit();">編集</button></p>
    </section>
</form>
<x-slot name="script">
    <script>
        function edit(){
            const form      =   document.getElementById("style-form");
            const formData  =   new FormData();
            let isChanged   =   false;
            form.querySelectorAll("input:not([name='_token']), textarea, select").forEach(input =>{
                const id        =   input.getAttribute("data-id");
                const previous  =   input.getAttribute("data-previous");
                const value     =   input.value;
                if(value != previous && value != "") {
                    formData.append(id, value);
                    isChanged = true;
                }
                if(value == previous || value == "") {
                    return;
                }
            });
            for(let data of formData.entries()){
                console.log(data);
            }
            if(isChanged){
                formData.append("_token",document.querySelector("input[name='_token']").value);
                const options    =   {
                    "method"    :   "post",
                    "body"      :   formData,
                }
                fetch("/edit/style/update", options).then(response => response.ok ? window.location.reload() : console.error("編集に失敗しました" , response.status));
                // fetch("/edit/style/update", options).then(response => response.ok ? console.log(response.status) : console.error("編集に失敗しました" , response.status));
                // fetch("/edit/style/update", options).then(response => response.json).then(data=>console.log(data));
            }
            if(!isChanged){
                console.log("変更された値はありません")
                return;
            }
        }
    </script>
</x-slot>
</x-website.frame.edit>
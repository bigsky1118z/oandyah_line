<x-website.frame.edit title="スタイル一覧">
<form id="style-form" action="/edit/style" method="post">
    @csrf
    <h2>スタイル一覧</h2>
    <p>
        <a href="/edit/style/default" class="button button-create">デフォルト一覧</a>
        <a href="/edit/style/create" class="button button-create">カスタマイズスタイル追加</a>
    </p>
    <section>
        <h3>カスタマイズ</h3>
        @if ($styles->isNotEmpty())
            <dl>
                <dd class="style-button"><span class="button button-edit" onclick="edit();">編集</span></dd>
            </dl>
            <dl class="dl-flex-left">
                <dt class="style-selector">セレクタ</dt>
                <dt class="style-property">プロパティ</dt>
                <dt class="style-value">値</dt>
                <dt class="style-button"></dt>
            </dl>
            @foreach ($styles as $style)
                <dl class="dl-flex-left">
                    <dd class="style-selector">{{ $style->selector }}</dd>
                    <dd class="style-property">{{ $style->property }}</dd>
                    <dd class="style-value"><input type="text" data-id="{{ $style->id }}" data-previous="{{ $style->value }}" value="{{ $style->value }}"></dd>
                    <dd class="style-button"><span class="button button-edit" onclick="edit();">編集</span></dd>
                    <dd class="style-button"><a href="/edit/style/{{ $sytle->id }}/delete" class="button button-delete">削除</a></dd>
                </dl>
            @endforeach
        @elseif ($styles->isEmpty())
            <p>現在デフォルトスタイルは設定されていません</p>
        @endif
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
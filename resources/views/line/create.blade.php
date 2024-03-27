@php
    $values =   array();
    if(isset($sns)){
        $array  =   array("name", "title", "description");
        foreach ($array as $key) {
            $values[$key]   =   $sns[$key];
        }
        if($sns->configs->count()){
            foreach ($sns->configs as $config) {
                $values[$config->name]   =   $config->value;
            }
        }
    }
    if(count(old())) {
        $values =   old();
    }
@endphp
<x-sns.frame.basic>
<x-slot name="id">create</x-slot>
{{-- <x-slot name="title"></x-slot> --}}
{{-- <x-slot name="description"></x-slot> --}}
{{-- <x-slot name="head"></x-slot> --}}
{{-- <x-slot name="h1"></x-slot> --}}
{{-- <x-slot name="h2"></x-slot> --}}
<x-slot name="header"></x-slot>
<section id="create">
    <h2>{{ isset($values["name"]) ? "設定変更" : "新規作成" }}</h2>
    <form action="/sns{{ isset($values["name"]) ? "/" . $values["name"] : null }}" method="post" enctype="multipart/form-data">
        @csrf
        <dl id="dl-sns-create">
            <dd class="dd-sns-create-body">
                <dl>
                    <dt class="dt-sns-create-title">名前</dt>
                    <dd class="dd-sns-create-value"><input type="text" name="name" value="{{ isset($values["name"]) ? $values["name"] : null }}" required></dd>
                </dl>
                <dl>
                    <dt class="dt-sns-create-title">タイトル</dt>
                    <dd class="dd-sns-create-value"><input type="text" name="title" value="{{ isset($values["title"]) ? $values["title"] : null }}" required></dd>
                </dl>
                <dl>
                    <dt class="dt-sns-create-title">アイコン</dt>
                    <dd class="dd-sns-create-value">
                        <dl>
                            <dd class="dd-sns-create-value-img">
                                @if (isset($values["name"]) && file_exists(public_path("storage/sns/icon/" . $values["name"] . ".jpg")))
                                    <img id="img-sns-icon" src="/storage/sns/icon/{{ $values["name"] }}.jpg">
                                @elseif (isset($values["name"]) && file_exists(public_path("storage/sns/icon/" . $values["name"] . ".png")))
                                    <img id="img-sns-icon" src="/storage/sns/icon/{{ $values["name"] }}.png">
                                @else
                                    <img id="img-sns-create-value-icon" src="/storage/sns/icon/default.png">
                                @endif
                            </dd>
                            <dd class="dd-sns-create-value-btn">
                                <input type="file" name="icon" accept="image/png, image/jpeg" onchange="imageUpload(this);" class="hidden">
                                <button type="button" onclick="this.closest('dd').querySelector('input[type=file][name=icon]').click();">追加</button>
                                {{-- <button type="button" onclick="">削除</button> --}}
                            </dd>
                        </dl>
                    </dd>
                </dl>
                <dl>
                    <dt class="dt-sns-create-title">概要</dt>
                    <dd class="dd-sns-create-value"><textarea name="description">{{ isset($values["description"]) ? $values["description"] : null }}</textarea></dd>
                </dl>
                <dl>
                    <dt class="dt-sns-create-title">表示形式</dt>
                    <dd class="dd-sns-create-value">
                        <select name="type">
                            @foreach ($types as $type_key => $type_value)
                                <option value="{{ $type_key }}" @selected(isset($values["type"]) && $values["type"] == $type_key )>{{ $type_value }}</option>
                            @endforeach
                        </select>
                    </dd>
                </dl>
            </dd>
            <dd>
                <dl class="dl-sns-create-footer">
                    <button type="submit">保存</button>
                </dl>
            </dd>
        </dl>
    </form>
</section>
<x-slot name="footer"></x-slot>
<x-slot name="hidden"></x-slot>
<x-slot name="script">
    <script>
        function imageUpload(input){
            if(input.files.length){
                const files =   input.files;
                let message =   "";
                let blob    =   "";
                for(const file of files){
                    if(file.size > 1024 * 1024){
                        message.length ?  message +=  "\n" : null;
                        message     +=  "1GB以下の画像を選択してください";
                    } else {
                        const reader    =   new FileReader();
                        reader.onload   =   function(e){
                            const img   =   document.getElementById("img-sns-icon");
                            img.src     =   e.target.result;
                        }
                        reader.readAsDataURL(file);
                    }
                }
                if(message.length){
                    input.value =   null;
                    window.alert(message);
                }
            }
        }
    </script>
</x-slot>
</x-sns.frame.basic>
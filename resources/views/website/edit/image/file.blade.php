<x-website.frame.edit>
<x-slot name="title">画像</x-slot>
<x-slot name="id">image</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
{{-- <x-slot name="h1"></x-slot> --}}
<x-slot name="h2"><a href="/edit/image">画像 TOP</a> > {{ $directory }}</x-slot>
<section>
    <dl>
        @if (!Str::contains($directory,array("all")))
            <dd><input type="file" onchange="file_store(this);" accept="image/*" class="hidden"></dd>
            <dd><button type="button" onclick="this.closest('dl').querySelector('dd>input[type=file]').click();">画像追加</button></dd>
        @endif
    </dl>
</section>
<section id="file">
    @csrf
    <dl id="dl-image-directory-file">
        @foreach ($files as $file)
            @php
                $path                               =   preg_replace("/public/", "storage", $file, 1);
                list($file_directory, $file_name)   =   array_slice(explode("/", $file), -2);
                list($name, $extension)             =   explode(".", $file_name);
            @endphp
            <dd>
                <dl class="dl-image-directory-file-value">
                    <dt class="dt-image-directory-file-value-image">
                        <img src="{{ url($path) }}">
                    </dt>
                    <dd class="dd-image-directory-file-value-name">
                        <input type="text" name="filename" data-directory="{{ $file_directory }}" data-filename="{{ $file_name }}" data-previous="{{ $name }}" value="{{ $name }}" onchange="file_rename(this);">.{{ $extension }}</dd>
                    <dd class="dd-image-directory-file-value-button">
                        <dl>
                            <dd><button type="button" data-imageurl="{{ url($path) }}" onclick="get_file_url(this);">URL取得</button></dd>
                            @if (in_array($directory, array("all", "tarot")))
                            @else
                                <dd><button type="button" onclick="location.href='/edit/image/{{ $file_directory }}/{{ $file_name }}/delete'">ファイル削除</button></dd>
                            @endif
                        </dl>
                    </dd>
                </dl>
            </dd>
        @endforeach
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script">
    <script>
        const token =   document.querySelector("input[name='_token']").value;

        function get_file_url(button) {
            const text  =   document.createElement("textArea");
            text.value  =   button.getAttribute("data-imageurl");
            document.body.appendChild(text);
            text.select();
            document.execCommand("copy");
            document.body.removeChild(text);
            button.textContent = "コピーしました";
            setTimeout(() => button.textContent = "URL取得", 1000);
        }

        function file_store(input) {
            const files =   input.files;
            if(files){
                const formData  =   new FormData();
                for(const file of files){
                    if(file.size <= 1024 * 1024){
                        formData.append("_token", token);
                        formData.append("file", file);
                        const options    =   {
                            "method"    :   "post",
                            "headers"   :   {
                                "enctype"   :   "multipart/form-data",
                            },
                            "body"      :   formData,
                        }
                        fetch("/edit/image/{{ $directory }}", options).then(response => response.ok ? location.reload() : console.log(response.status));
                    }else{
                        alert("ファイルサイズを1MB以下にしてください。");
                    }
                }
            }
        }


        function file_rename(input) {
            const value     =   input.value;
            const previous  =   input.getAttribute("data-previous");
            if(value == previous) {
                return false;
            }
            if(value != previous) {
                const directory =   input.getAttribute("data-directory");
                const filename  =   input.getAttribute("data-filename");
                const newname   =   filename.replace(previous, value);
                const formData  =   new FormData();
                    formData.append("_token", token);
                    formData.append("filename", filename);
                    formData.append("newname", newname);
                const options    =   {
                    "method"    :   "post",
                    "body"      :   formData,
                };
                fetch(`/edit/image/${directory}/rename`, options).then(response => response.json()).then(data=>{
                    const message = data.message;
                    switch(message){
                        case "元のファイル名と新しいファイル名が同じです。":
                        case "新しいファイル名は既に存在します。":
                            input.value =   previous;
                            alert(message);
                            break;
                        case "新しいファイル名に変更しました。":
                            input.setAttribute("data-previous",value);
                            input.setAttribute("data-filename",newname);
                            break;
                    }
                });
            }
        }
    </script>
</x-slot>
</x-website.frame.edit>
<x-website.frame.edit>
<x-slot name="title">画像</x-slot>
<x-slot name="id">image</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="header"></x-slot>
{{-- <x-slot name="h1"></x-slot> --}}
<x-slot name="h2">画像 TOP</x-slot>
<section id="directory">
    <dl id="dl-image-directory">
        <dt><h3>画像ディレクトリ一覧</h3></dt>
        <dd>
            <dl class="dl-flex">
                <dd class="dd-image-directory-name">all</dd>
                <dd class="dd-image-directory-button">
                    <dl class="dl-flex">
                        <dd>
                            <button type="button" onclick="location.href='/edit/image/all'">全画像表示</button>
                        </dd>
                    </dl>
                </dd>
            </dl>
        </dd>
        @foreach ($directories as $directory)
            @php
                $directory_name =   preg_replace("/public\/image\//", "", $directory, 1);
            @endphp
            <dd>
                <dl class="dl-flex">
                    <dd class="dd-image-directory-name">{{ $directory_name }}</dd>
                    <dd class="dd-image-directory-button">
                        <dl class="dl-flex">
                            <dd>
                                <button type="button" onclick="location.href='/edit/image/{{ $directory_name }}'">表示</button>
                                @if ($directory_name != "tarot")
                                    <button type="button" onclick="location.href='/edit/image/{{ $directory_name }}/delete'">削除</button>
                                @endif
                            </dd>
                        </dl>
                    </dd>
                </dl>
            </dd>
        @endforeach
        <dd>
            <form action="/edit/image" method="post">
                @csrf
                <dl class="dl-flex">
                    <dd class="dd-image-directory-name"><input type="text" name="directory"></dd>
                    <dd class="dd-image-directory-button">
                        <dl class="dl-flex">
                            <dd>
                                <button type="submit">新規作成</button>
                            </dd>
                        </dl>
                    </dd>
                </dl>
            </form>
        </dd>
    </dl>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>    
</x-website.frame.edit>        



{{-- <section>
    <dl class="dl-flex-left">
        <dt class="image-directory-name"><input type="text" name="directory"></dt>
        <dd class="image-directory-button"><button type="button" class="button button-create" onclick="store(this);">作成</button></dd>
    </dl>
</section>
<x-slot name="script">
    <script>
        function store(button){
            const token     =   document.querySelector("input[name='_token']").value;
            const directory =   button.closest("dl").querySelector("dt > input[name=directory]").value;
            if(directory){
                const formData  =   new FormData();
                formData.append("_token", token);
                formData.append("directory", directory);
                const options   =   {
                    "method"    :   "post",
                    "body"      :   formData,
                };
                fetch("/edit/image", options).then(response => response.json()).then(data=>{
                    const message   =   data.message;
                    if(message == "success"){
                        location.reload();
                    }else{
                        setPopUp(message, 2000);
                    }
                });
            }
        }
    </script>
</x-slot>
</x-website.frame.edit> --}}
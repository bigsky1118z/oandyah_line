<x-admin.api.line.frame.basic title="画像" heading="画像" :channel="$channel">
<x-slot name="head">
</x-slot>
<section>
    <h3>アップロード</h3>
    <label>
        <input type="file" name="file" onchange="imageStore(this);" accept="image/*" style="display: none;">
        <button type="button" onclick="this.closest('label').querySelector('input[type=file]').click();">画像を選択</button>
        <p style="color:#FF0000;"></p>
    </label>
</section>
<section>
    <h3>画像一覧</h3>
    @if (!empty($images))
        <p><button data-filename="all" onclick="window.confirm('削除した後は復元できませんがよろしいですか？') ? imageDelete(this) : null">すべて削除</button></p>
        <div style="display: flex; width: 100%; flex-wrap: wrap;">
            @foreach ($images as $image)
                <div style="display: flex; flex-direction: column; width: 30%; padding: 1%">
                    <img src="{{ url($image["path"]) }}">
                    <p>
                        <label>
                            <input type="text" name="{{ $image["name"] }}" value="{{ $image["name"] }}" onclick="this.select()"><span>.{{ $image["extension"] }}</span>
                            <button data-filename="{{ $image["filename"] }}" data-extension="{{ $image["extension"] }}" onclick="imageRename(this);">変更</button>
                        </label>
                    </p>
                    <p><span>{{ $image["created_at"] }}</span><span>{{ "[" . $image["size"] . " KB]" }}</span></p>
                    <p><button data-filename="{{ $image["filename"] }}" onclick="imageDelete(this);">削除</button></p>
                </div>
            @endforeach
        </div>
    @elseif (empty($images))
        <p>保存されている画像はありません</p>
    @endif
</section>
<x-slot name="script">
<script>
    function imageStore(input) {
        const files    =   input.files;
        if(files){
            const file     =   files[0];
            if(file.size <= 1024 * 1024){
                const formData  =   new FormData();
                formData.append("file", file);
                const options    =   {
                    "method"    :   "post",
                    "headers"   :   {
                        "enctype"   :   "multipart/form-data",
                    },
                    "body"      :   formData,
                }
                fetch(`/api/line/{{ $channel->channel_name }}/image`, options)
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    } else {
                        console.error('画像のアップロードに失敗しました', error);
                    }
                })
                .catch(error => {
                    console.error('通信エラーが発生しました', error);
                });
            } 
            if(file.size > 1024 * 1024){
                input.value =   null;
                input.closest("label").querySelector("p").textContent   =   "画像サイズは1MB以下にしてください"
            }
        }
    }

    function imageRename(button) {
        const input     =   button.closest("label").querySelector("input");
        const formData  =   new FormData();
            formData.append("filename", button.getAttribute("data-filename"));
            formData.append("newname", input.value + "." + button.getAttribute("data-extension"));
        const options    =   {
            "method"    :   "post",
            "body"      :   formData,
        }
        fetch("/api/line/{{ $channel->channel_name }}/image/rename", options)
        .then(response => window.location.reload());
    }

    function imageDelete(button) {
        const formData  =   new FormData();
            formData.append("filename", button.getAttribute("data-filename"));
        const options    =   {
            "method"    :   "post",
            "body"      :   formData,
        }
        fetch("/api/line/{{ $channel->channel_name }}/image/delete", options).then(response => {
            if (response.ok) {
                window.location.reload();
            } else {
                throw new Error(response.status);
            }
        })
        .catch(error => {
            console.error(error)
            // console.error('通信エラーが発生しました', error);
        });
    }
</script>
</x-slot>
</x-admin.api.line.frame.basic>
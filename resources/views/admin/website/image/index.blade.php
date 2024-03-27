<x-admin.website.frame.basic title="Images" heading="画像一覧">
<x-slot name="head" >
<style>
    div#container   {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }
    div.image-box   {
        width: 25%;
    }
    div.image-box img  {
        width: 100%;
        height: auto;
    }
    div.image-box input  {
        width: 100%;
    }
</style>
</x-slot>
<section>
    <h3>アップロード</h3>
    <form action="/admin/website/image" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">upload</button>
    </form>
</section>
<section>
    <div id="container">
        @foreach ($images as $image)
        <div class="image-box">
            <img src="/{{ $image['src'] }}" alt="{{ $image['name'] }}">
            <p><input type="text" value="{{ $image['name'] }}" onclick="this.select()" readonly></p>
            <p>
                <button type="button" onclick="deleteImage(this)" value="{{ $image['name'] }}">delete</button>
            </p>
        </div>
        @endforeach
    </div>
</section>

<x-slot name="script">
    <script>
        function getImageLink(param){
            return navigator.clipboard.writeText(param.value).then(function(){
                this.contentText = "succeed";
                setTimeout(() => {
                    this.contentText = "get link";
                }, 1000);
            });
        }
    </script>
</x-slot>
</x-admin.website.frame.basic>
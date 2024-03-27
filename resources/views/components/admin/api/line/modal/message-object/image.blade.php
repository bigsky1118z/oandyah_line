@php
use Illuminate\Support\Facades\File;

$imgFolderPath = public_path('storage/images');
if(is_dir($imgFolderPath)){
    $imageFiles = File::files($imgFolderPath);
    $imageUrls = [];
    foreach ($imageFiles as $file) {
        $imageUrl = asset('storage/images' . $file->getFilename());
        $imageUrls[] = $imageUrl;
    }
}else {
}
@endphp
<x-admin.api.line.frame.modal :id="$id" type="message">
<form>
    <dl>
        <dt>メイン画像</dt>
        <dd class="content-dd"></dd>
        <dd class="select-dd">
            <button type="button" onclick="imageSelectButton(this);">画像選択</button>
            <input type="text" class="addImage" name="originalContentUrl" accept="image/*" onchange="imageSelect(this);" style="display:none;">
        </dd>
    </dl>
    <dl>
        <dt>プレビュー画像※省略可能</dt>
        <dd class="content-dd"></dd>
        <dd class="select-dd">
            <button type="button" onclick="imageSelectButton(this);">画像選択</button>
            <input type="text" class="addImage" name="previewImageUrl" accept="image/*" onchange="imageSelect(this);" style="display:none;">
        </dd>
    </dl>
</form>
</x-admin.api.line.frame.modal>
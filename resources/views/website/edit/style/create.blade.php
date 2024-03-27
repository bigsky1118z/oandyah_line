<x-website.frame.edit title="スタイル追加">
<section>
    <h2>カスタマイズスタイル</h2>
    <form action="/edit/style" method="post">
        @csrf
        <dl class="dl-flex-left">
            <dt class="style-create">セレクタ</dt>
            <dt class="style-create">プロパティ</dt>
            <dt class="style-create">値</dt>
        </dl>
        @foreach (range(0,9) as $number)
            <dl class="dl-flex-left">
                <dd class="style-create"><input type="text" name="style[{{ $number }}][selector]" placeholder="(例)h1, table#id, div.class ..."></dd>
                <dd class="style-create">
                    <input type="text" name="style[{{ $number }}][property]" list="datalist-property" placeholder="(例)color, width, display ..." autocomplete="off">
                    <datalist id="datalist-property">
                        <option value="color"></option>
                        <option value="background-color"></option>
                        <option value="font-size"></option>
                        <option value="display"></option>
                        <option value="width"></option>
                        <option value="height"></option>
                    </datalist>
                </dd>
                <dd class="style-create"><input type="text" name="style[{{ $number }}][value]" placeholder="(例)#FF0000, 100px, none ..."></dd>
            </dl>            
        @endforeach
        <dl class="dl-flex-left">
            <dd class="style-create"></dd>        
            <dd class="style-create"><button type="submit" class="button button-create">作成</button></dd>        
            <dd class="style-create"></dd>        
        </dl>
    </form>
</section>
</x-website.frame.edit>
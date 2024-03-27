<x-admin.api.line.frame.basic title="リッチメニュー" heading="リッチメニュー" :channel="$channel">
<x-slot name="head">
</x-slot>
<form action="/api/line/{{ $channel->channel_name }}/richmenu" method="post" enctype="multipart/form-data">
    @csrf
    <dl class="dl-flex-left">
        <dt>リッチメニュー名（管理用）</dt>
        <dd><input type="text" name="name" max="300" required></dd>
    </dl>
    <dl class="dl-flex-left">
        <dt>メニューバーテキスト</dt>
        <dd><input type="text" name="chatBarText" max="14" required></dd>
    </dl>
    <dl class="dl-flex-left">
        <dt>横</dt>
        <dd><input id="create-richmenu-size-width" type="number" name="size[width]" min="800" max="2500" oninput="setMaxWidth(this);" required></dd>
    </dl>
    <dl class="dl-flex-left">
        <dt>縦</dt>
        <dd><input id="create-richmenu-size-height" type="number" name="size[height]" min="250" max="1724" oninput="setMaxHeight(this);" required></dd>
    </dl>
    <dl class="dl-flex-left">
        <dt>デフォルト表示</dt>
        <dd>
            <select name="selected" required>
                <option value="true">表示する</option>
                <option value="false">表示しない</option>
            </select>
        </dd>
    </dl>
    <dl class="dl-flex-left">
        <dt>メニュー画像</dt>
        <dd><input type="file" name="image"></dd>
    </dl>
    <dl class="dl-flex-left">
        <dt>エリア</dt>
        <dd>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>label</th>
                        <th>x</th>
                        <th>y</th>
                        <th>width</th>
                        <th>height</th>
                        <th>type</th>
                        <th>data</th>
                </tr>
                </thead>
                <tbody>
                        @foreach (range(0,19) as $number)
                        <tr>
                            <td>{{ $number + 1 }}</td>
                            <td><input type="text" name="areas[{{ $number }}][action][label]" max="20" @if ($loop->first) required @endif ></td>
                            <td><input type="number" class="actions-area-width" name="areas[{{ $number }}][bounds][x]" min="0" max="2500" @if ($loop->first) required @endif ></td>
                            <td><input type="number" class="actions-area-height" name="areas[{{ $number }}][bounds][y]"  min="0" max="1724" @if ($loop->first) required @endif ></td>
                            <td><input type="number" class="actions-area-width" name="areas[{{ $number }}][bounds][width]" min="0" max="2500" @if ($loop->first) required @endif ></td>
                            <td><input type="number" class="actions-area-height" name="areas[{{ $number }}][bounds][height]"  min="0" max="1724" @if ($loop->first) required @endif ></td>
                            <td><input type="string" name="areas[{{ $number }}][action][type]" @if ($loop->first) required @endif ></td>
                            <td><input type="string" name="areas[{{ $number }}][action][data]" @if ($loop->first) required @endif ></td>
                            <td><input type="hidden" name="areas[{{ $number }}][action][inputOption]" value="closeRichMenu"></td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </dd>
        </dl>
    <dl class="dl-flex-left">
        <dd><input type="submit" value="作成"></dd>
    </dl>
</form>

<x-slot name="script">
<script>
    function setMaxWidth(input){
        if(input.value){
            const target    =   document.getElementById("create-richmenu-size-height");
            const max       =   Math.floor(input.value/1.45);
            target.setAttribute("max",max);

            document.querySelectorAll("input.actions-area-width").forEach(node => node.setAttribute("max",input.value));
        }
    }

    function setMaxHeight(input){
        if(input.value){
            document.querySelectorAll("input.actions-area-height").forEach(node => node.setAttribute("max",input.value));
        }
    }
</script>
</x-slot>
</x-admin.api.line.frame.basic>
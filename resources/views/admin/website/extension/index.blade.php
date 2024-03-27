<x-admin.website.frame.basic title="Extension - Setting" heading="拡張機能編集">
<x-slot name="head">
    <style>
        td {

        }
    </style>
</x-slot>
<form action="/admin/website/extension" method="post">
@csrf
@foreach ($extension as $section => $items)
    <h3>{{ $section }}</h3>
    @switch($section)
    @case('logo')
        <table>
            <tbody>
                @php
                    $log_option = $items->where('section','logo')->where('name','option')->first();
                    $log_src    = $items->where('section','logo')->where('name','src')->first();
                    $log_text   = $items->where('section','logo')->where('name','text')->first();
                @endphp
                <tr>
                    <th>選択</th>
                    <td>
                        <label for="logo-option-0"><input type="radio" name="logo[option]" id="logo-option-0" value="0" @if (isset($log_option) && $log_option->value == '0') checked @endif>表示なし</label>
                        <label for="logo-option-1"><input type="radio" name="logo[option]" id="logo-option-1" value="1" @if (isset($log_option) && $log_option->value == '1') checked @endif>テキストのみ</label>
                        <label for="logo-option-2"><input type="radio" name="logo[option]" id="logo-option-2" value="2" @if (isset($log_option) && $log_option->value == '2') checked @endif>ロゴのみ</label>
                        <label for="logo-option-3"><input type="radio" name="logo[option]" id="logo-option-3" value="3" @if (isset($log_option) && $log_option->value == '3') checked @endif>ロゴ＋テキスト</label>
                        <label for="logo-option-4"><input type="radio" name="logo[option]" id="logo-option-4" value="4" @if (isset($log_option) && $log_option->value == '4') checked @endif>テキスト＋ロゴ</label>
                    </td>
                </tr>
                <tr>
                    <th>タイトル</th>
                    <td><input type="text" name="logo[text]" value="@if(isset($log_text)){{ $log_text->value }}@endif"></td>
                </tr>
                <tr>
                    <th>画像</th>
                    <td>
                        <input type="text" name="logo[src]" value="@if(isset($log_src)){{ $log_src->value }}@endif" oninput="preview_logo(this);" onerror="this.onerror = null; this.src='';">
                        <img src="@if(isset($log_src)){{ $log_src->value }}@endif" width="50px" height="auto">
                    </td>
                </tr>
            </tbody>
        </table>        
        @break
    @case(2)
            
        @break
    @default
            
    @endswitch
@endforeach
<input type="submit" onclick="window.onbeforeunload=null;" value="save">
</form>


<x-slot name="hidden">
</x-slot>
<x-slot name="script">
    <x-.admin.website.parts.script.button />
    <x-.admin.website.parts.script.onbeforeunload />
    <script>
        function preview_logo(param) {
            const value =   param.value;
            const img   =   param.nextElementSibling;
            img.setAttribute('src', value);
            img.setAttribute('onerror', "this.onerror = null; this.src='';");
        }
    </script>
</x-slot>
</x-admin.website.frame.basic>
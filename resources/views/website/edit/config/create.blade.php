<x-website.frame.edit>
<x-slot name="title">config</x-slot>
<x-slot name="id">config</x-slot>
<x-slot name="head"></x-slot>
<x-slot name="h1"><a href="/edit">edit</a></x-slot>
<x-slot name="header"></x-slot>
<x-slot name="h2"><a href="/edit/config">config</a> > {{ $name }}</x-slot>
<section id="create">
    <h3>edit {{ $name }}</h3>
    <form action="/edit/config/{{ $name }}" method="post" enctype="multipart/form-data">
        @csrf
        <dl>
            <dt>
                <dl class="dl-flex">
                    <dd class="dd-config-create-before">before</dd>
                    <dd class="dd-config-create-after">after</dd>
                    <dd class="dd-config-create-button">button</dd>
                </dl>
            </dt>
            <dd>
                <dl class="dl-flex">
                    @switch($name)
                        @case("title")
                            <dd class="dd-config-create-before">{{ $value }}</dd>
                            <dd class="dd-config-create-after"><input type="text" name="value" value="{{ $value }}" required></dd>
                            @break
                        @case("description")
                            <dd class="dd-config-create-before">{!! nl2br($value) !!}</dd>
                            <dd class="dd-config-create-after"><textarea name="value" required>{{ $value }}</textarea></dd>
                            @break
                        @case("header_logo_title")
                            @isset($header_logo_titles)
                                <dd class="dd-config-create-before">{{ isset($header_logo_titles[$value]) ? $header_logo_titles[$value] : "---" }}</dd>
                                <dd class="dd-config-create-after">
                                    <select name="value">
                                        @foreach ($header_logo_titles as $key => $header_logo_title)
                                            <option value="{{ $key }}" @selected($value == $key)>{{ $header_logo_title }}</option>
                                        @endforeach
                                    </select>                                
                                </dd>
                            @endisset
                            @break
                        @case("display_header_logo_title")
                        @case("display_header_image")
                            @isset($is_displays)
                                <dd class="dd-config-create-before">{{ isset($is_displays[$value]) ? $is_displays[$value] : "---" }}</dd>
                                <dd class="dd-config-create-after">
                                    <select name="value">
                                        @foreach ($is_displays as $key => $is_display_value)
                                            <option value="{{ $key }}" @selected($value == $key)>{{ $is_display_value }}</option>
                                        @endforeach
                                    </select>                                
                                </dd>
                            @endisset
                            @break
                        @case("membership_page")
                            @isset($membership_pages)
                                <dd class="dd-config-create-before">{{ isset($membership_pages[$value]) ? $membership_pages[$value] : "---" }}</dd>
                                <dd class="dd-config-create-after">
                                    <select name="value">
                                        @foreach ($membership_pages as $key => $membership_page)
                                            <option value="{{ $key }}" @selected($value == $key)>{{ $membership_page }}</option>
                                        @endforeach
                                    </select>
                                </dd>
                            @endisset
                            @break
                        @case("layout_single")
                        @case("layout_multiple")
                        @case("layout_multiple_article")
                        @case("layout_menu")
                            <dd class="dd-config-create-before">{{ $value }}</dd>
                            <dd class="dd-config-create-after">
                                <select name="value">
                                    <option value="default" @selected($value == "default")>default</option>
                                    @for ($num = 1; $num <=10; $num++)
                                        @php
                                            $layout_num = "layout-" . str_pad($num, 3, '0', STR_PAD_LEFT);
                                        @endphp
                                        <option value="{{ $layout_num }}" @selected($value == $layout_num)>{{ $layout_num }}</option>
                                    @endfor
                                </select>
                            </dd>
                            @break
                        @case("logo")
                        @case("favicon")
                        @case("no_image")
                            <dd class="dd-config-create-before">{!! file_exists(public_path("storage/image/website/" . $value)) ? "<img src='/storage/image/website/" . $value . "'>" : "画像を選択してください" !!}</dd>
                            <dd class="dd-config-create-after">
                                <dl class="dl-flex flex-column flex-center">
                                    <dd>
                                        <img class="hidden" id="img-preview" src="">
                                        <input class="hidden" type="file" name="value" @if($name=="logo" || $name=="no_image") accept="image/png" @elseif($name=="favicon") accept="image/ico" @endif required>
                                    </dd>
                                    <dd>
                                        <button type="button" onclick="document.querySelector('input[name=value]').click();">画像選択</button>
                                    </dd>
                                </dl>
                            </dd>
                            @break
                    @endswitch
                    <dd class="dd-config-create-button">
                        <button type="submit">save</button>
                    </dd>
                </dl>
            </dd>
        </dl>
    </form>
</section>
<x-slot name="hidden"></x-slot>
<x-slot name="footer"></x-slot>
<x-slot name="script"></x-slot>    
</x-website.frame.edit>
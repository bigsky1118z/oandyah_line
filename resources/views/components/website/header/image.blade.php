@switch($option)
    @case("image-header")
        <div class="image-header">
            <img src="https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png">
        </div>
        @break
    @case("image-header-max")
        <div class="image-header image-header-max">
            <img src="https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png">
        </div>
        @break
    @default
@endswitch

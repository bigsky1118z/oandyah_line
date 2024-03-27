<div id="header-logo-title" class="{{ strpos($config,"fixed") !== false ? "header-logo-title-fixed " : null }}{{ strpos($config,"left") !== false ? "header-logo-title-left " : null }}{{ strpos($config,"right") !== false ? "header-logo-title-right " : null }}">
    <h1>
        <a href="/">
            @if (strpos($config,"logo") !== false)
                @if(file_exists(public_path("storage/image/website/logo.png")))
                    <img class="logo" src="/storage/image/website/logo.png" @if (strpos($config, "title") === false ) alt="{{ $title }}" @endif>
                @endif
            @endif
            @if (strpos($config,"title") !== false)
                <span class="title">{{ $title }}</span>
            @endif
        </a>
    </h1>
</div>
@if (strpos($config,"fixed") !== false)
    <div class="header-blank"></div>
@endif


<x-frame.web>
    <x-slot name="id">user-app-image-index</x-slot>
    <x-slot name="title">画像一覧</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name.'/app') }}">アプリ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id) }}">{{ $app->display_name ?? $app->client_id }}</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/image') }}">画像一覧</a></li>
        @foreach ($pathes as $value)
            <li><a href="{{ $href = $href.'/'.$value }}">{{ $value }}</a></li>
        @endforeach
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name }}</h2>
        <section>
            <h3>フォルダ一覧</h3>
            <ul class="image-directory-index">
                @foreach (($directories ?? array()) as $directory)
                    <li><a href="{{ $href.'/'.($directory["basename"] ?? null) }}">{{ $directory["basename"] ?? null }}</a></li>
                @endforeach
            </ul>
            <p>
                <form action="{{ $href }}" method="post">
                    @csrf
                    <input type="text" name="directory" required>
                    <button type="submit">フォルダ作成</button>
                </form>
            </p>
        </section>
        <section>
            <h3>画像一覧</h3>
            <p>
                <form action="{{ $href }}" method="post" onchange="this.submit();" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="images[]" class="hidden" accept="image/*" style="display: none;" multiple>
                    <button type="button" onclick="this.closest('form').querySelector(`input[name='images[]']`).click();">アップロード</button>
                </form>
            </p>
            <ul class="image-file-index">
                    @foreach (($files ?? array()) as $file)
                        <li>
                            <dl>
                                <dd><img src="{{ asset('storage/app/'.$app->client_id.'/image/'.($path ? '/'.$path : null).'/'.($file['basename'] ?? null))  }}" alt=""></dd>
                                <dt>
                                    <form action="{{ $href }}" method="post">
                                        @csrf            
                                        <input type="text" name="rename" value="{{ $file['filename'] ?? null }}"  onchange="this.value ? this.closest('form').submit() : null">
                                        <span>.{{ $file['extension'] ?? null }}</span>
                                        <input type="hidden" name="basename" value="{{ $file['basename'] ?? null }}">
                                    </form>
                                </dt>
                                <dd>
                                    <form action="{{ $href }}" method="post">
                                        @csrf
                                        @method("delete")
                                        <button type="submit" name="filename" value="{{ $file['basename'] ?? null }}">削除</button>
                                    </form>
                                </dd>
                            </dl>
                        </li>
                    @endforeach
                </ul>
        </section>
        @if (count($pathes ?? array()))
            <section>
                <h3>フォルダ削除</h3>
                <div>
                    <form action="{{ $href }}" method="post">
                        @csrf
                        @method("delete")
                        <button type="submit" name="directory_name" value="{{ $path ?? null }}">削除</button>
                    </form>
                </div>
            </section>            
        @endif
    </x-slot>
    <x-slot name="footer"></x-slot>
    <x-slot name="hidden"></x-slot>
    <x-slot name="script"></x-slot>
</x-frame.web>


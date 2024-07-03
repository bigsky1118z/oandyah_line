<x-frame.web>
    <x-slot name="id">user-app-reply-create</x-slot>
    <x-slot name="title">自動返信作成</x-slot>
    <x-slot name="description"></x-slot>
    <x-slot name="head"></x-slot>
    <x-slot name="header"></x-slot>
    <x-slot name="page_transition_list">
        <li><a href="{{ asset($user->name) }}">マイページ</a></li>
        <li><a href="{{ asset($user->name.'/app') }}">アプリ一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id) }}">{{ $app->display_name ?? $app->client_id }}</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/reply') }}">自動返信一覧</a></li>
        <li><a href="{{ asset($user->name.'/app/'.$app->client_id.'/reply/'.($reply->id ?? 'create')) }}">{{ $reply->name ?? "新規作成" }}</a></li>
    </x-slot>
    <x-slot name="main">
        <h2>{{ $app->display_name }}</h2>
        <section>
            <h3>{{ $reply->name ?? "新規作成" }}</h3>
            <ul>
                <li><button type="button" onclick="location.href='{{ asset($user->name.'/app/'.$app->client_id.'/reply') }}'">一覧へ戻る</button></li>
            </ul>
            <form action="{{ asset($user->name.'/app/'.$app->client_id.'/reply/'.($reply->id ?? null)) }}" method="post">
                @csrf
                <table>
                    <thead></thead>
                    <tbody>
                        <tr>
                            <th>タイトル</th>
                            <td><input type="text" name="name" value="{{ $reply->name ?? null }}"></td>
                        </tr>
                        <tr>
                            <th>カテゴリ</th>
                            <td>
                                <select name="category" onchange="select_cagetory(this);">
                                    @foreach ($categories as $category => $category_title)
                                        <option value="{{ $category }}" @selected($category ==  ($reply->category ?? null))>{{ $category_title ?? $category }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>メッセージタイプ</th>
                            <td>
                                <select name="type" onchange="select_message_type(this);">
                                    @if ($reply->type != null)
                                        <option value="{{ $reply->type }}">{{ $reply->get_type() }}</option>
                                    @else
                                        <option value="">---</option>
                                        @foreach ($types as $type => $type_title)
                                            <option value="{{ $type }}" @disabled($type == "follow" && $app->replies()->where("type","follow")->exists())>{{ $type_title ?? null }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>返信条件</th>
                            <td id="reply-query">
                                @switch(($reply->type ?? null))
                                    @case("message")    <x-web.replies.create.message id="" :reply="$reply" />  @break
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th>メッセージ選択</th>
                            <td>
                                <select name="mode">
                                    @foreach ($modes as $key => $value)
                                        <option value="{{ $key }}"  @selected($key ==  ($reply->mode ?? null))>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>status</th>
                            <td>
                                <select name="status">
                                    @foreach ($statuses as $key => $value)
                                        <option value="{{ $key }}"  @selected($key ==  ($reply->status ?? null)) @disabled($key == "draft")>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"><button type="submit">保存</button></td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </section>
        @if ($reply->id)
            <section>
                <h3>返答メッセージ</h3>
                <ul>
                    <li><button type="button" onclick="location.href='{{ asset($user->name.'/app/'.$app->client_id.'/reply/'.$reply->id.'/message') }}'">作成</button></li>
                </ul>
                <table>
                    <thead>
                        <tr>
                            <th>タイトル</th>
                            <th>状態</th>
                            <th>エラー</th>
                            <th>メッセージ</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reply->messages as $message)
                            <tr>
                                <td>{{ $message->name ?? null }}</td>
                                <td>{{ $message->get_status() ?? null }}</td>
                                <td>{{ $message->error_message ?? null }}</td>
                                <td><x-web.messages.show.message_objects :objects="$message->messages ?? array()" /></td>
                                <td>
                                    <ul>
                                        <li><button type="button" onclick="location.href='{{ asset($user->name.'/app/'.$app->client_id.'/reply/'.$reply->id.'/message/'.$message->id) }}'">編集</button></li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        @endif
    </x-slot>
    <x-slot name="footer"></x-slot>
    <x-slot name="hidden">
        <x-web.replies.create.sumples :reply="$reply" />
    </x-slot>
    <x-slot name="script">
        <script>
            function select_cagetory(select){

            }
            function select_message_type(select){
                const value         =   select.value;
                const target        =   document.getElementById("reply-query");
                target.innerHTML    =   null;
                const sumple        =   document.getElementById("sumple-reply-query-"+value);
                if(sumple){
                    const table         =   sumple.cloneNode(true);
                    table.id            =   null;
                    target.appendChild(table);
                }
            }
            function add_keywords(button){
                const table =   button.closest("table");
                const tfoot =   table.querySelector("tfoot");
                const tbody =   table.querySelector("tbody");
                const tr    =   tfoot.querySelector("tr.sumple-reply-query-keywords-tr").cloneNode(true);
                tr.classList.remove("hidden");
                tbody.appendChild(tr);
            }
            function remove_keyword(button){
                button.closest("tr").remove();
            }
        </script>
    </x-slot>
</x-frame.web>
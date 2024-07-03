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
                            <th>メッセージタイプ</th>
                            <td>
                                <select name="type">
                                    @if (($reply->type ?? null) == "follow")
                                        <option value="follow">友だち追加</option>
                                    @elseif ($app->replies()->where("type","follow")->doesntExist())
                                        <option value="follow"  @selected("follow" ==  ($reply->type ?? null))>友だち追加</option>
                                        <option value="message" @selected("message" ==  ($reply->type ?? null))>メッセージ</option>
                                    @else
                                        <option value="message">メッセージ</option>
                                    @endif
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>返信方法</th>
                            <td>
                                <select name="mode">
                                    @foreach ($modes as $key => $value)
                                        <option value="{{ $key }}"  @selected($key ==  ($reply->mode ?? null))>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        @if (($reply->type ?? null) != "follow")
                            <tr>
                                <th>一致条件</th>
                                <td>
                                    <select name="match">
                                        @foreach ($matches as $key => $value)
                                            <option value="{{ $key }}"  @selected($key ==  ($reply->match ?? null))>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>キーワード</th>
                                <td>
                                    <table id="reply-keword">
                                        <tbody>
                                            @foreach (($reply->keyword ?? array()) as $keyword)
                                                <tr>
                                                    <td><input type="text" name="keyword[]" value="{{ $keyword }}"></td>
                                                    <td><button type="button" onclick="remove_keyword(this);">削除</button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2"><button type="button" onclick="add_keyword();">追加</button></td>
                                            </tr>
                                            <tr id="sumple-reply-keyword-tr" class="hidden">
                                                <td><input type="text" name="keyword[]"></td>
                                                <td><button type="button" onclick="remove_keyword(this);">削除</button></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </td>
                            </tr>
                        @endif
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
    <x-slot name="hidden"></x-slot>
    <x-slot name="script">
        <script>
            function add_keyword(){
                const table =   document.getElementById("reply-keword");
                const tbody =   table.querySelector("tbody");
                const tr    =   document.getElementById("sumple-reply-keyword-tr").cloneNode(true);
                tr.removeAttribute("id");
                tr.classList.remove("hidden");
                tbody.appendChild(tr);
            }
            function remove_keyword(button){
                button.closest("tr").remove();
            }
        </script>
    </x-slot>
</x-frame.web>
<x-admin.api.line.frame.basic title="メッセージ" heading="メッセージ" :channel="$channel">
<x-slot name="head">
</x-slot>
<ul>
    <li><a href="/api/line/{{ $channel->channel_name }}/message/create/text">テキスト</a></li>
    <li><a href="/api/line/{{ $channel->channel_name }}/message/create/image">画像</a></li>
    <li><a href="/api/line/{{ $channel->channel_name }}/message/create/location">位置情報</a></li>
    <li><a href="/api/line/{{ $channel->channel_name }}/message/create/template-buttons">選択ボタン</a></li>
    <li><a href="/api/line/{{ $channel->channel_name }}/message/create/template-confirm">確認ボタン</a></li>
</ul>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>カテゴリ</th>
            <th>メッセージ名</th>
            <th>タイプ</th>
            <th>内容</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($messages as $message)
            <tr>
                <td>{{ $message->id }}</td>
                <td>{{ $message->category }}</td>
                <td>{{ strpos($message->name, 'autofill') == 0 ? "no name" : $message->name }}</td>
                <td>{{ $message->type }}</td>
                <td>{!! $message->get_preview() !!}</td>
                {{-- <td>
                    <ul>
                        @isset ($message->text) <li>{!! preg_replace('/\\n/', '<br>', $message->text) !!}</li> @endisset
                        @isset ($message->emojis) <li>{{ $message->emojis }}</li> @endisset
                        @isset ($message->package_id) <li>{{ $message->package_id }}</li> @endisset
                        @isset ($message->sticker_id) <li>{{ $message->sticker_id }}</li> @endisset
                        @isset ($message->original_content_url)
                            @if ($message->type == "image")
                            <li><a href="{{ $message->original_content_url }}" target="_blank" rel="noopener noreferrer"><img src="{{ $message->original_content_url }}" height="100px" width="auto"></a></li>
                            @elseif ($message->type == "video")
                            <li><a href="{{ $message->original_content_url }}" target="_blank" rel="noopener noreferrer">動画</a></li>
                            @elseif ($message->type == "audio")
                            <li><a href="{{ $message->original_content_url }}" target="_blank" rel="noopener noreferrer">音声</a></li>
                            @endif
                        @endisset
                        @isset ($message->preview_image_url) <li><a href="{{ $message->preview_image_url }}" target="_blank" rel="noopener noreferrer"><img src="{{ $message->preview_image_url }}" height="100px" width="auto"></a></li> @endisset
                        @isset ($message->tracking_id) <li>{{ $message->tracking_id }}</li> @endisset
                        @isset ($message->duration) <li>{{ $message->duration }}</li> @endisset
                        @isset ($message->title) <li>{{ $message->title }}</li> @endisset
                        @isset ($message->address) <li>{{ $message->address }}</li> @endisset
                        @isset ($message->latitude) <li>{{ $message->latitude }}</li> @endisset
                        @isset ($message->longitude) <li>{{ $message->longitude }}</li> @endisset
                        @isset ($message->alt_text) <li>{{ $message->alt_text }}</li> @endisset
                        @isset ($message->template)
                            @isset($message->template["thumbnailImageUrl"]) <li><img src="{{ $message->template['thumbnailImageUrl'] }}" height="100px" width="auto"></li> @endisset
                            @isset($message->template["imageAspectRatio"]) <li>{{ $message->template["imageAspectRatio"] }}</li> @endisset
                            @isset($message->template["imageSize"]) <li>{{ $message->template["imageSize"] }}</li> @endisset
                            @isset($message->template["imageBackgroundColor"]) <li>{{ $message->template["imageBackgroundColor"] }}</li> @endisset
                            @isset($message->template["title"]) <li>{{ $message->template["title"] }}</li> @endisset
                            @isset($message->template["text"]) <li>{{ $message->template["text"] }}</li> @endisset
                            @isset($message->template["defaultAction"])
                                <li>
                                    <dl class="dl-flex-left">
                                        <dt>デフォルトアクション</dt>
                                        @isset($message->template["defaultAction"]['type']) <dd>{{ $message->template["defaultAction"]['type'] }}</dd> @endisset
                                        @isset($message->template["defaultAction"]['label']) <dd>{{ $message->template["defaultAction"]['label'] }}</dd> @endisset
                                        @isset($message->template["defaultAction"]['data']) <dd>{{ $message->template["defaultAction"]['data'] }}</dd> @endisset
                                        @isset($message->template["defaultAction"]['displayText']) <dd>{{ $message->template["defaultAction"]['displayText'] }}</dd> @endisset
                                        @isset($message->template["defaultAction"]['inputOption']) <dd>{{ $message->template["defaultAction"]['inputOption'] }}</dd> @endisset
                                        @isset($message->template["defaultAction"]['fillInText']) <dd>{{ $message->template["defaultAction"]['fillInText'] }}</dd> @endisset
                                        @isset($message->template["defaultAction"]['text']) <dd>{!! preg_replace('/\\n/', '<br>', $message->template["defaultAction"]['text']) !!}</dd> @endisset
                                        @isset($message->template["defaultAction"]['uri']) <dd>{{ $message->template["defaultAction"]['uri'] }}</dd> @endisset
                                        @isset($message->template["defaultAction"]['mode']) <dd>{{ $message->template["defaultAction"]['mode'] }}</dd> @endisset
                                        @isset($message->template["defaultAction"]['initial']) <dd>{{ $message->template["defaultAction"]['initial'] }}</dd> @endisset
                                        @isset($message->template["defaultAction"]['max']) <dd>{{ $message->template["defaultAction"]['max'] }}</dd> @endisset
                                        @isset($message->template["defaultAction"]['min']) <dd>{{ $message->template["defaultAction"]['min'] }}</dd> @endisset
                                        @isset($message->template["defaultAction"]['richMenuAliasId']) <dd>{{ $message->template["defaultAction"]['richMenuAliasId'] }}</dd> @endisset
                                    </dl>
                                </li>
                            @endisset
                            @isset($message->template["actions"])
                                @foreach ($message->template["actions"] as $action_index => $action)
                                    <li>
                                        <dl class="dl-flex-left">
                                            <dt>アクション{{ $action_index+1 }}</dt>
                                            @isset($action['type']) <dd>{{ $action['type'] }}</dd> @endisset
                                            @isset($action['label']) <dd>{{ $action['label'] }}</dd> @endisset
                                            @isset($action['data']) <dd>{{ $action['data'] }}</dd> @endisset
                                            @isset($action['displayText']) <dd>{{ $action['displayText'] }}</dd> @endisset
                                            @isset($action['inputOption']) <dd>{{ $action['inputOption'] }}</dd> @endisset
                                            @isset($action['fillInText']) <dd>{{ $action['fillInText'] }}</dd> @endisset
                                            @isset($action['text']) <dd>{!! preg_replace('/\\n/', '<br>', $action['text']) !!}</dd> @endisset
                                            @isset($action['uri']) <dd>{{ $action['uri'] }}</dd> @endisset
                                            @isset($action['mode']) <dd>{{ $action['mode'] }}</dd> @endisset
                                            @isset($action['initial']) <dd>{{ $action['initial'] }}</dd> @endisset
                                            @isset($action['max']) <dd>{{ $action['max'] }}</dd> @endisset
                                            @isset($action['min']) <dd>{{ $action['min'] }}</dd> @endisset
                                            @isset($action['richMenuAliasId']) <dd>{{ $action['richMenuAliasId'] }}</dd> @endisset
                                        </dl>
                                    </li>
                                @endforeach
                            @endisset
                            @isset($message->template["columns"])
                                <li>
                                    <dl class="dl-flex-left">
                                        <dd>
                                            @foreach ($message->template["columns"] as $column_index => $column)
                                                <dl>
                                                    <dt>カラム{{ $column_index }}</dt>
                                                    @isset($column["thumbnailImageUrl"]) <dd><img src="{{ $column['thumbnailImageUrl'] }}" height="100px" width="auto"></dd> @endisset
                                                    @isset($column['imageBackgroundColor']) <dd>{{ $column['imageBackgroundColor'] }}</dd> @endisset
                                                    @isset($column['title']) <dd>{{ $column['title'] }}</dd> @endisset
                                                    @isset($column['text']) <dd>{{ $column['text'] }}</dd> @endisset
                                                    @isset($column["imageUrl"]) <dd><img src="{{ $column['imageUrl'] }}" height="100px" width="auto"></dd> @endisset
                                                    @isset($column["defaultAction"])
                                                        <dd>
                                                            <dl class="dl-flex-left">
                                                                <dt>デフォルトアクション</dt>
                                                                @isset($column["defaultAction"]['type']) <dd>{{ $column["defaultAction"]['type'] }}</dd> @endisset
                                                                @isset($column["defaultAction"]['label']) <dd>{{ $column["defaultAction"]['label'] }}</dd> @endisset
                                                                @isset($column["defaultAction"]['data']) <dd>{{ $column["defaultAction"]['data'] }}</dd> @endisset
                                                                @isset($column["defaultAction"]['displayText']) <dd>{{ $column["defaultAction"]['displayText'] }}</dd> @endisset
                                                                @isset($column["defaultAction"]['inputOption']) <dd>{{ $column["defaultAction"]['inputOption'] }}</dd> @endisset
                                                                @isset($column["defaultAction"]['fillInText']) <dd>{{ $column["defaultAction"]['fillInText'] }}</dd> @endisset
                                                                @isset($column["defaultAction"]['text']) <dd>{!! preg_replace('/\\n/', '<br>', $column["defaultAction"]['text']) !!}</dd> @endisset
                                                                @isset($column["defaultAction"]['uri']) <dd>{{ $column["defaultAction"]['uri'] }}</dd> @endisset
                                                                @isset($column["defaultAction"]['mode']) <dd>{{ $column["defaultAction"]['mode'] }}</dd> @endisset
                                                                @isset($column["defaultAction"]['initial']) <dd>{{ $column["defaultAction"]['initial'] }}</dd> @endisset
                                                                @isset($column["defaultAction"]['max']) <dd>{{ $column["defaultAction"]['max'] }}</dd> @endisset
                                                                @isset($column["defaultAction"]['min']) <dd>{{ $column["defaultAction"]['min'] }}</dd> @endisset
                                                                @isset($column["defaultAction"]['richMenuAliasId']) <dd>{{ $column["defaultAction"]['richMenuAliasId'] }}</dd> @endisset
                                                            </dl>
                                                        </dd>
                                                    @endisset
                                                    @isset($column["actions"])
                                                        @foreach ($column["actions"] as $action_index => $action)
                                                            <dd>
                                                                <dl class="dl-flex-left">
                                                                    <dt>アクション{{ $action_index+1 }}</dt>
                                                                    @isset($action['type']) <dd>{{ $action['type'] }}</dd> @endisset
                                                                    @isset($action['label']) <dd>{{ $action['label'] }}</dd> @endisset
                                                                    @isset($action['data']) <dd>{{ $action['data'] }}</dd> @endisset
                                                                    @isset($action['displayText']) <dd>{{ $action['displayText'] }}</dd> @endisset
                                                                    @isset($action['inputOption']) <dd>{{ $action['inputOption'] }}</dd> @endisset
                                                                    @isset($action['fillInText']) <dd>{{ $action['fillInText'] }}</dd> @endisset
                                                                    @isset($action['text']) <dd>{!! preg_replace('/\\n/', '<br>', $action['text']) !!}</dd> @endisset
                                                                    @isset($action['uri']) <dd>{{ $action['uri'] }}</dd> @endisset
                                                                    @isset($action['mode']) <dd>{{ $action['mode'] }}</dd> @endisset
                                                                    @isset($action['initial']) <dd>{{ $action['initial'] }}</dd> @endisset
                                                                    @isset($action['max']) <dd>{{ $action['max'] }}</dd> @endisset
                                                                    @isset($action['min']) <dd>{{ $action['min'] }}</dd> @endisset
                                                                    @isset($action['richMenuAliasId']) <dd>{{ $action['richMenuAliasId'] }}</dd> @endisset
                                                                </dl>
                                                            </dd>
                                                        @endforeach
                                                    @endisset
                                                    @isset($column["action"])
                                                        <dd>
                                                            <dl class="dl-flex-left">
                                                                <dt>アクション</dt>
                                                                @isset($column["action"]['type']) <dd>{{ $column["action"]['type'] }}</dd> @endisset
                                                                @isset($column["action"]['label']) <dd>{{ $column["action"]['label'] }}</dd> @endisset
                                                                @isset($column["action"]['data']) <dd>{{ $column["action"]['data'] }}</dd> @endisset
                                                                @isset($column["action"]['displayText']) <dd>{{ $column["action"]['displayText'] }}</dd> @endisset
                                                                @isset($column["action"]['inputOption']) <dd>{{ $column["action"]['inputOption'] }}</dd> @endisset
                                                                @isset($column["action"]['fillInText']) <dd>{{ $column["action"]['fillInText'] }}</dd> @endisset
                                                                @isset($column["action"]['text']) <dd>{!! preg_replace('/\\n/', '<br>', $column["action"]['text']) !!}</dd> @endisset
                                                                @isset($column["action"]['uri']) <dd>{{ $column["action"]['uri'] }}</dd> @endisset
                                                                @isset($column["action"]['mode']) <dd>{{ $column["action"]['mode'] }}</dd> @endisset
                                                                @isset($column["action"]['initial']) <dd>{{ $column["action"]['initial'] }}</dd> @endisset
                                                                @isset($column["action"]['max']) <dd>{{ $column["action"]['max'] }}</dd> @endisset
                                                                @isset($column["action"]['min']) <dd>{{ $column["action"]['min'] }}</dd> @endisset
                                                                @isset($column["action"]['richMenuAliasId']) <dd>{{ $column["action"]['richMenuAliasId'] }}</dd> @endisset
                                                            </dl>
                                                        </dd>
                                                    @endisset
                                                </dl>
                                            @endforeach
                                        </dd>
                                    </dl>
                                </li>
                            @endisset
                        @endisset
                        イメージマップ
                        @isset ($message->base_url) <li>{{ $message->base_url }}</li> @endisset
                        @isset ($message->base_size) <li>{{ $message->base_size }}</li> @endisset
                        @isset ($message->video) <li>{{ $message->video }}</li> @endisset
                        @isset ($message->actions) <li>{{ $message->actions }}</li> @endisset
                        フレックスメッセージ
                        @isset ($message->contents) <li>{{ $message->contents }}</li> @endisset
                    </ul>
                </td> --}}
                {{-- <td>{{ json_encode($message->get_message_object()) }}</td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
</x-admin.api.line.frame.basic>
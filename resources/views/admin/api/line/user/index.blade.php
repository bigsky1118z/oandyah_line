<x-admin.api.line.frame.basic title="友達情報" heading="友達情報" :channel="$channel">
<x-slot name="head">
</x-slot>
<p>このページに表示されるのはシステム導入後、チャンネルに何かしらのアクションをした人のみです。</p>
<dl class="dl-flex-left">
    <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/user/create'">手動追加</button></dd>
    <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/user/info'">一斉更新</button></dd>
    <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/user/csv/export'">CSVエクスポート</button></dd>
    <dd>
        <form action="/api/line/{{ $channel->channel_name }}/user/csv/import" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" id="input-file-csv" name="csv" accept=".csv" style="display: none;" onchange="this.closest('form').submit()">
        </form>
        <button type="button" onclick="document.getElementById('input-file-csv').click()">CSVインポート</button>
    </dd>
</dl>
<section>
    <h3>グループ</h3>
    <ul>
        @foreach ($line_api_user_groups as $line_api_user_group)
            <li><a href="/api/line/{{ $channel->channel_name }}/user/group/{{ $line_api_user_group->id }}">{{ $line_api_user_group->name }}</a>({{ $line_api_user_group->line_api_users->count() }})</li>
        @endforeach
    </ul>
</section>
@foreach ($line_api_users as $follow => $line_api_user)
<section>
    <h3>{{ array("follow"=>"有効","unfollow"=>"無効")[$follow] }}なアカウント</h3>
    <dl class="dl-flex-left">
        <dt>アイコン</dt>
        <dt>LINE設定名</dt>
        <dt>登録名</dt>
        <dt>識別名</dt>
        <dt>敬称</dt>
        <dt>コメント</dt>
        <dt>メモ</dt>
        <dt>ボタン</dt>
    </dl>
    @foreach ($line_api_user as $item)
    <dl class="dl-flex-left">
        <dd>{{ $item->id }}</dd>
        <dd>{!! isset($item->picture_url) ? "<img src='$item->picture_url' width='20px' height='20px'>" : null !!}</dd>
        <dd>{{ $item->display_name }}</dd>
        <dd>{{ $item->registed_name }}</dd>
        <dd>{{ $item->name_to_identify }}</dd>
        <dd>{{ $item->honorific }}</dd>
        <dd>{{ $item->status_message }}</dd>
        <dd>{{ $item->memo }}</dd>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/user/{{ $item->id }}'">詳細</button></dd>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/user/{{ $item->id }}/edit'">編集</button></dd>
        <dd><button onclick="location.href='/api/line/{{ $channel->channel_name }}/user/{{ $item->id }}/info'">更新</button></dd>
    </dl>
    @endforeach
</section>
@endforeach
<section>
    <h3>友達分析</h3>
    <dl class="dl-flex-left dl-dt-120px">
        <dt>友達登録</dt>
        <dd>
            @foreach (array("followers"=>"合計","targetedReaches"=>"有効なアカウント","blocks"=>"無効なアカウント") as $key => $title)
                <dl class="dl-flex-left">
                    <dt>{{ $title }}</dt>
                    <dd>{{ $followers[$key] }}</dd>
                </dl>
            @endforeach
        </dd>
    </dl>
    
    @isset($demographic["genders"])
        <dl class="dl-flex-left dl-dt-120px">
            <dt>性別</dt>
            <dd>
                @foreach ($demographic["genders"] as $gender)
                    <dl class="dl-flex-left">
                        <dt>{{ array("male"=>"男性", "female"=>"女性", "unknown"=>"不明")[$gender['gender']] }}</dt>
                        <dd>{{ $gender['percentage'] }}</dd>
                    </dl>
                @endforeach
            </dd>
        </dl>
    @endisset
    
    @isset($demographic["ages"])
    @php
        $demographic["ages"] = array_filter($demographic["ages"],function($area){
            return $area['percentage'];
        });
        usort($demographic["ages"],function($a,$b){
            return $a['age'] <=> $b['age'];
        });
    @endphp
    <dl>
        <dt>年齢</dt>
        <dd>
            <table>
                <tr>
                    @foreach ($demographic["ages"] as $age)
                    <th>{{ $age['age'] =="unknown" ? "不明" : str_replace(["from","to"], ["","-"], $age["age"]) }}</th>
                    @endforeach
                </tr>
                <tr>
                    @foreach ($demographic["ages"] as $age)
                    <td>{{ $age["percentage"] }}</td>
                    @endforeach
                </tr>
            </table>
        </dd>
    </dl>
    @endisset
    
    
    
    @isset($demographic["areas"])
    @php
        $demographic["areas"] = array_filter($demographic["areas"],function($area){
            return $area['percentage'];
        });
    @endphp
    <dl>
        <dt>地域</dt>
        <dd>
            <table>
                <tr>
                    @foreach ($demographic["areas"] as $area)
                    <th>{{ $area['area'] == "unknown" ? "不明" : $area['area'] }}</th>
                    @endforeach
                </tr>
                <tr>
                    @foreach ($demographic["areas"] as $area)
                    <th>{{ $area['percentage'] }}</th>
                    @endforeach
                </tr>
            </table>
        </dd>
    </dl>
    @endisset
    
    @isset($demographic["appTypes"])
    @php
        $demographic["appTypes"] = array_filter($demographic["appTypes"],function($appType){
            return $appType['percentage'];
        });
    @endphp
    <dl>
        <dt>OS</dt>
        <dd>
            <table>
                <tr>
                    @foreach ($demographic["appTypes"] as $appType)
                    <th>{{ $appType['appType'] == "others" ? "その他" : $appType['appType'] }}</th>
                    @endforeach
                </tr>
                <tr>
                    @foreach ($demographic["appTypes"] as $appType)
                    <th>{{ $appType['percentage'] }}</th>
                    @endforeach
                </tr>
            </table>
        </dd>
    </dl>
    @endisset
    
    @isset($demographic["subscriptionPeriods"])
    @php
        $demographic["subscriptionPeriods"] = array_filter($demographic["subscriptionPeriods"],function($subscriptionPeriod){
            return $subscriptionPeriod['percentage'];
        });
        $subscription_period_names    =   array(
            "within7days"   =>  "7日未満",
            "within30days"  =>  "30日未満",
            "within90days"  =>  "90日未満",
            "within180days" =>  "180日未満",
            "within365days" =>  "365日未満",
            "over365days"   =>  "365日以上",
            "unknown"       =>  "不明",
        );
    @endphp
    <dl>
        <dt>登録日数</dt>
        <dd>
            <table>
                <tr>
                    @foreach ($demographic["subscriptionPeriods"] as $subscriptionPeriod)
                    <th>{{ $subscription_period_names[$subscriptionPeriod['subscriptionPeriod']] }}</th>
                    @endforeach
                </tr>
                <tr>
                    @foreach ($demographic["subscriptionPeriods"] as $subscriptionPeriod)
                    <th>{{ $subscriptionPeriod['percentage'] }}</th>
                    @endforeach
                </tr>
            </table>
        </dd>
    </dl>
    @endisset
</section>
</x-admin.api.line.frame.basic>
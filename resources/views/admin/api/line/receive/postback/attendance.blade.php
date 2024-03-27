<x-admin.api.line.frame.basic title="{{ $name }}[{{ $actions[$action] }}] -受信データ" heading="{{ $name }}[{{ $actions[$action] }}]" :channel="$channel">
<x-slot name="head">
</x-slot>
<h3>データログ</h3>
 <table>
    <thead>
        <tr>
            <th>受信日時</th>
            <th>名前</th>
            <th>詳細</th>
            <th>補足</th>
            <th>値</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($postbacks as $postback)
        @isset ($postback->postback)
        <tr>
            <td>{{ $postback->created_at }}</td>
            <td>{{ $postback->user->nickname() }}</td>
            <td>{{ $postback->get_data('detail') }}</td>
            <td>{{ $postback->get_data('extra') }}</td>
            <td>{{ $postback->get_data('value') }}</td>
            <td><input type="checkbox" onchange="setReaction(this, {{ $postback->id }}, 'created')" {{ $postback->get_reaction("created") ? "checked" : null }}></td>
            <td><input type="checkbox" onchange="setReaction(this, {{ $postback->id }}, 'offered')" {{ $postback->get_reaction("offered") ? "checked" : null }}></td>
        </tr>
        @endisset
        @endforeach
    </tbody>
</table>
<x-slot name="script">
<script>
    function setReaction(checkbox, id, reaction){
        const data      =   new FormData();
            data.append("id", id);
            data.append("reaction", reaction);
            data.append("checked", checkbox.checked ? "checked" : "unchecked");
            console.log(checkbox.checked);
        const options   =    {
            "method"    :   "post",
            "body"      :   data,
        };
        fetch("/api/line/{{ $channel->channel_name }}/receive/postback/{{ $action }}/{{ $name }}", options).then(response =>{
            console.log(response);
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('HTTP status code: ' + response.status);
            }
        }).then(data =>{
            console.log(data);
        }).catch(error =>{
                console.error(error);
            });
    }
</script>
</x-slot>
</x-admin.api.frame.basic>
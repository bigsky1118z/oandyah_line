<script>
    function changeIsActive(checkbox){
        const id    =   checkbox.value;
        const url   =   checkbox.checked ? `/api/line/{{ $channel->channel_name }}/reply/{{ $type }}/${id}/active` : `/api/line/{{ $channel->channel_name }}/reply/{{ $type }}/${id}/inactive`;
        const options   =   {
            "method"    :   "post",
        };
        fetch(url, options).then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('HTTP status code: ' + response.status);
            }
        }).then(data => {
            console.log(data);
        }).catch(error => console.error(error));
    }
</script>

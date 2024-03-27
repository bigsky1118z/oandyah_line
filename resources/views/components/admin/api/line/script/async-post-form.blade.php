<script>
    function postForm(button) {
        let validate    =   true;
        const formData  =   new FormData(button.closest("form"));
        button.closest("form").querySelectorAll("input, textarea, select").forEach(node=> node.required && !node.value ? validate = false : null);
        if(validate){
            const options   =   {
                "method"    :   "post",
                "body"      :   formData,
            }
            fetch("/api/line/{{ $channel->channel_name }}/{{ $path }}", options).then(response=>{
                if(response.ok){
                    window.parent.reloadSelect();
                    const iframe    =window.frameElement;
                    iframe.closest("div").classList.add("hidden");
                    const iframePathSelector    =   iframe.closest("div").querySelector("select.select-iframe-path");
                    iframePathSelector ? iframePathSelector.value = "" : null;
                    iframe.removeAttribute("src");
                } else {
                    throw new Error(response.status);
                }
            }).catch(error=>console.error(error));
        }else{
            console.log("validation error");
        }
    }
</script>
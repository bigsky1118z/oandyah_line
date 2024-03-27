<div style="display: none;">
    <button type="button" onclick="buttonThreadUp(this);" >
    <button type="button" onclick="buttonThreadUp(this);" id="buttonThreadUp" >↑</button>
    <button type="button" onclick="buttonThreadDown(this);" id="buttonThreadDown" >↓</button>
    <button type="button" onclick="buttonThreadDelete(this);" id="buttonThreadDelete" >×</button>
    <button type="button" onclick="buttonThreadDeleteToTheLast(this);" id="buttonThreadDeleteToTheLast" >×</button>
    <button type="button" onclick="buttonThreadAdd(this);" id="buttonThreadAdd" >+</button>
</div>

<script>
    function buttonThreadUp(param) {
        const tbody = param.closest('tbody');
        const thread = param.closest('tr');
        if(thread.previousElementSibling){
            tbody.insertBefore(thread,thread.previousElementSibling);
        }
    }    
    function buttonThreadDown(param) {
        const tbody = param.closest('tbody');
        const thread = param.closest('tr');
        if(thread.nextElementSibling){
            tbody.insertBefore(thread.nextElementSibling,thread);
        }
    }
    function buttonThreadDelete(param){
        const tbody = param.closest('tbody');
        const length = tbody.children.length;
        if(length>1 && confirm('Are you sure to delete?')){
            param.closest('tr').remove();
        }
        if(length<=1){
            confirm('cannot be deleted')
        }
    }

    function buttonThreadDeleteToTheLast(param){
        const tbody = param.closest('tbody');
        if(confirm('Are you sure to delete?')){
            param.closest('tr').remove();
        }
    }
    
    function buttonThreadAdd(param) {
        const tbody = param.closest('tbody');
        const thread = param.closest('tr');
        const newThread = thread.cloneNode(true);
        Array.from(newThread.querySelectorAll('select, input, textareta')).forEach(node=>{
            node.value = null;
        });
        tbody.insertBefore(newThread,thread.nextElementSibling);
    }
</script>

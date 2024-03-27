<script>
    const editor = document.getElementById('editor');
    const editorInput = document.getElementById('editor-input');
    const toolbarOptions = [
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],        // heading
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],                     // block
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],     // list
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        ['link', 'image', 'video'],                       // data
        ['clean'],                                        // remove formatting button
    ];
    const options = {
        theme : 'bubble',
        modules : {
            toolbar : toolbarOptions,
        },
    };
    const quill = new Quill(editor,options);
    quill.on('text-change', function(delta, oldDelta, source) {
        const editorHtml = editor.querySelector('.ql-editor').innerHTML;
        editorInput.value = editorHtml;
    });
</script>
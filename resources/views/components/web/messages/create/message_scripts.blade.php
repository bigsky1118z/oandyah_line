<script>
    function select_messages_type(select){
        const value         =   select.value;
        const index         =   select.getAttribute("data-index");
        const target        =   document.getElementById("messages-"+index+"-object");
        target.innerHTML    = '';
        const sumple        =   document.getElementById("sumple-message-messages-type-" + value);
        if(sumple){
            const div   =   sumple.cloneNode(true);
            div.removeAttribute("id");
            div.querySelectorAll("input,select,textarea").forEach(node=>{
                const name  =   node.name;
                node.name   =   name.replace("[{sumple}]","["+index+"]");
                node.setAttribute("data-index",index);
            });
            target.appendChild(div);
        }
    }
    function input_image_url(input){
        const value         =   input.value;
        const img           =   input.closest("dl").querySelector("img");
        img.src             =   value;
        const message_box   =   input.closest("dl").querySelector("p");
        const name          =   input.name.includes("originalContentUrl")   ? "original"
                            :   input.name.includes("previewImageUrl")      ? "preview"
                            :   null;
        let errors          =   new Array();
        (value.indexOf("https://") == 0) ? null : errors.push("「https://」で始まるURLを指定してください");
        (value.indexOf("https://") == 0) ? null : errors.push("「https://」で始まるURLを指定してください");
        if(errors.length == 0){
            fetch(value).then(response =>{
                if(response.ok){
                    const content_type      =   response.headers.get('Content-Type');
                    const content_length    =   response.headers.get('Content-Length');
                    ["image/jpeg","image/png"].includes(content_type)       ?   null    :   errors.push("画像ファイルは「jpg」または「png」のみ使用可能です");
                    // (name == "original"  && content_length<=(1024*1024*10)) ?   null    :   errors.push("画像サイズは「10MB」以下に設定してください");
                    // (name == "preview"   && content_length<=(1024*1024))    ?   null    :   errors.push("画像サイズは「1MB」以下に設定してください");
                    if(errors.length > 0){
                        input.value =   null;
                        img.src     =   "#";
                    }
                } else {
                    img.src     =   value;
                    errors.push("画像の情報を上手く読み取れませんでした。送信できない可能性があります。");
                }
            }).catch(error=>{
                console.log("error");
                img.src     =   value;
                errors.push("画像の情報を上手く読み取れませんでした。送信できない可能性があります。");
            }).then(()=>{
                message_box.innerHTML   =   errors.join("<br>");
            });
        } else {
            input.value             =   null;
            img.src                 =   "#";
            message_box.innerHTML   =   errors.join("<br>");
        }
    }
</script>

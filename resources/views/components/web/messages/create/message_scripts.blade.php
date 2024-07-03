<script>
    function select_message_type(select){
        const value         =   select.value;
        const index         =   select.getAttribute("data-index")   ?? null;
        const parent        =   select.getAttribute("data-parent")  ?? null;
        const target        =   select.closest(parent).querySelector(".message-object");
        target.innerHTML    =   '';
        const sumple        =   document.getElementById("sumple-message-messages-type-" + value);
        if(sumple){
            const div   =   sumple.cloneNode(true);
            div.removeAttribute("id");
            div.querySelectorAll("input,select,textarea").forEach(node=>{
                const name  =   node.name;
                const id    =   node.id;
                node.name   =   name.replace("[{index}]","["+index+"]");
                node.id     =   id.replace("-{index}-","-"+index+"-");
                node.setAttribute("data-index",index);
            });
            target.appendChild(div);
        }
    }
    function select_template_type(select){
        const value         =   select.value;
        const index         =   select.getAttribute("data-index")   ?? null;
        const parent        =   select.getAttribute("data-parent")  ?? null;
        const object        =   select.closest(parent).querySelector(".template-object");
        object.innerHTML    =   '';
        const object_sumple =   document.getElementById("sumple-message-messages-type-template-" + value);
        if(object_sumple){
            const div   =   object_sumple.cloneNode(true);
            div.removeAttribute("id");
            div.querySelectorAll("input,select,textarea").forEach(node=>{
                const name  =   node.name;
                const id    =   node.id;
                node.name   =   name.replace("[{index}]","["+index+"]");
                node.id     =   id.replace("-{index}-","-"+index+"-");
                node.setAttribute("data-index",index);
            });
            object.appendChild(div);
        }
    }
    /** アクションタイプ */
    function select_action_type(select){
        const parent        =   select.getAttribute("data-parent")      ?? null;
        const target        =   select.closest(parent).querySelector(".action-object");
        target.innerHTML    = '';
        const area          =   select.getAttribute("data-area")    ?? null;
        const value         =   select.value                        ?? null;
        const sumple        =   document.getElementById("sumple-"+area+"-type-" + value);
        if(sumple){
            const index     =   select.getAttribute("data-index")   ?? null;
            const choice    =   select.getAttribute("data-choice")  ?? null;
            const column    =   select.getAttribute("data-column")  ?? null;
            const div       =   sumple.cloneNode(true);
            div.removeAttribute("id");
            div.querySelectorAll("input,select,textarea").forEach(node=>{
                const name  =   node.name;
                node.name   =   name.replace("[{index}]","["+index+"]").replace("[{column}]","["+column+"]").replace("[{choice}]","["+choice+"]");
            });
            target.appendChild(div);
        }
    }

    function input_image_url(input){
        const value         =   input.value;
        const img           =   input.closest("dl").querySelector("img");
        img.src             =   value;
        img.classList.remove("hidden");
        const message_box   =   input.closest("dl").querySelector("p");
        let errors          =   new Array();
        (value.indexOf("https://") == 0) ? null : errors.push("「https://」で始まるURLを指定してください");
        (value.indexOf("https://") == 0) ? null : errors.push("「https://」で始まるURLを指定してください");
        if(errors.length == 0){
            fetch(value).then(response =>{
                if(response.ok){
                    const content_type      =   response.headers.get('Content-Type');
                    ["image/jpeg","image/png"].includes(content_type)   ?   null    :   errors.push("画像ファイルは「jpg」または「png」のみ使用可能です");
                    // const max_length        =   input.name.includes("originalContentUrl")   ?   1024*1024*10    :
                    //                             input.name.includes("previewImageUrl")      ?   1024*1024       :
                    //                             null;                                
                    // const content_length    =   response.headers.get('Content-Length');
                    // content_length <= max_length    ?   null    :   errors.push("画像サイズは「10MB」以下に設定してください");
                    if(errors.length > 0){
                        input.value =   null;
                        img.src     =   "#";
                        img.classList.add("hidden");
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
            img.classList.add("hidden");
            message_box.innerHTML   =   errors.join("<br>");
        }
    }

</script>

<script>
    /** EndpointS TYPE SELECT */
        /** type を選択し、MODAL を開く 調整済み */
        function addEndpoint(param){
            // select に値がある場合、 MODAL を開く
            if(param.value){
                switch(param.value){
                    case("push"):
                    case("narrowcast"):
                        openModal(param);
                        break;
                    default:
                        break;
                }
            }
            // select に値がない場合、初期状態に戻す
            if(!param.value){
                param.closest("dl").querySelector("dd.select-dd button.clearEndpoint").click();
            }
        }
        /** 入力されている値を編集する MODAL を開く 調整済み */
        function editEndpoint(param) {
            // content-dd に要素がある場合、 select の値を取得し、それに応じた MODAL を開く
            const contentDd =   param.closest("dl").querySelector("dd.content-dd");
            if(contentDd.querySelectorAll("input").length>0){
                const select    =   param.closest("dl").querySelector('dd.select-dd select.selectEndpoint');
                const values    =   new Object();
                // content-dd に収納されているデータの値を values に格納する
                Array.from(contentDd.querySelectorAll('input, textarea, select')).forEach(node => {
                    values[node.name]   =   node.value;
                });
                openModal(select, values);
            }
        }
        /** 選択した列を初期状態に戻す 調整済み */
        function clearEndpoint(param) {
            // select の値を "" にする
            const select    =   param.closest("dl").querySelector('dd.select-dd select.selectEndpoint');
            select.value    =   "";
            // content-dd 内の要素をすべて削除する
            const contentDd =   param.closest("dl").querySelector('dd.content-dd');
            while(contentDd.lastChild){
                contentDd.removeChild(contentDd.lastChild);
            }
        }
    /** ENDPOINT MODAL */
        /** ENDPOINTS TYPE SELECT の値に対応する MODAL を開く 調整済み */
        function openEndpointModal(param, values) {
            // MODAL のサンプルを取得する
            const modal =   document.getElementById(`modal-endpoint-${param.value.replace(/_/g, "-")}`);
            if(modal){
                // MODAL のサンプルがある場合 MODAL を CLONE して開く
                const newModal  =   modal.cloneNode(true);
                newModal.style.display  =   "block";
                newModal.setAttribute('id', param.id.replace('type','modal'));
                newModal.querySelector('.modal-content form').setAttribute('id', param.id.replace('type','form'));

                // MODAL内のinput,textarea,selectのnameとidを変換する
                // values がある場合はそれぞれ入力する
                Array.from(newModal.querySelector(".modal-content form").querySelectorAll('input, textarea, select, button')).forEach(node => {
                    if(node.name){
                        // id と name を変換する
                        const newNodeId     =   param.id.replace("type",node.name.replace(/\]/g,"").split("[").join("-"));
                        node.setAttribute('id', newNodeId);
                        const newNodeName   =   param.name.replace("[type]", `[${node.name.replace(/\]/g,"").split("[").join("][")}]`);
                        node.setAttribute('name', newNodeName);

                        // valueが与えられている場合、代入する
                        if(values && values[node.name]){
                            if(node.type == "checkbox"){
                                node.checked    =   true;
                            }
                            if(node.type != "checkbox"){
                                node.value      =   values[node.name];
                            }
                        }
                    }
                });
                // select に data-previous-value がある場合、キャンセルボタンに value を設定する
                if(param.hasAttribute("data-previous-value")) {
                    const cancelEndpointModal  =   newModal.querySelector("button.cancelEndpointModal");
                    cancelEndpointModal.value  =   param.getAttribute("data-previous-value");
                }

                // div#modalにdisplay:blockで追加する
                document.querySelector("div#modal").appendChild(newModal);

                param.setAttribute('data-previous-value', param.value);
            } else {
                // MODAL のサンプルがない場合 MODALは開かず select を元の値に戻す
                if(param.hasAttribute("data-previous-value")) {
                    param.value =   param.getAttribute("data-previous-value");
                }
                if(!param.hasAttribute("data-previous-value")) {
                    param.value =   "";
                }
            }
        }
        /** MODAL 内で入力された値を content-td に出力する 調整済み */
        function outputEndpointModal(param) {
            const form      =   param.closest("div").querySelector("div.modal-content form");
            const select    =   document.getElementById(form.id.replace("form","type"));
            // required がすべて入力されているか validation する
            let isValidate  =   true;
            const labels    =   new Array();
            // content-td に挿入する処理
            Array.from(form.querySelectorAll("input, textarea, select")).forEach(node => {
                // required が一つでも入力されていない場合 isValidate を flase にする
                if(node.required && !node.value){
                    isValidate  =   false;
                    node.setAttribute("placeholder","※必須");
                }
                if(node.value){
                    // input を 変換して content-td に挿入する
                    if(node.name.includes("endpoint[push]")){
                        if(node.checked){
                            const label     =   document.createElement("label");
                            // input が checkbox のとき
                            if(node.hasAttribute("data-nickname")){
                                label.innerHTML +=  node.getAttribute("data-nickname");
                            }
                            const input =   document.createElement("input");
                                input.setAttribute("type", "hidden");
                                input.setAttribute("name", node.name);
                                input.setAttribute("value", node.value);
                            label.appendChild(input);
                            // label を 配列 labels に挿入する
                            labels.push(label);
                        }
                    }
                    if(node.name.includes("endpoint[narrowcast]")){
                    }
                }
            });
            // validate が true の場合、 MODAL を削除する
            if(isValidate && labels.length){
                // content-td 内にある要素をすべて削除する
                const contentDd =   select.closest("dl").querySelector("dd.content-dd");
                while(contentDd.lastChild){
                    contentDd.removeChild(contentDd.lastChild);
                }
                // 配列 labels 内の label を content-td に追加する
                labels.forEach(label=>contentDd.appendChild(label));
                document.getElementById(form.id.replace("form","modal")).remove();
            }
            if(!isValidate || !labels.length){
                console.log('validate');
            }
        }
        /** MODAL を開く前の状態に戻す 再確認 */
        function cancelEndpointModal(param) {
            // form の id　から MESSGAE TYPE の SELECT を取得する
            const form      =   param.closest("div").querySelector("div.modal-content form");
            const select    =   document.getElementById(form.id.replace("form","type"));
            // キャンセルボタン に 以前のSELECTの値が value としてある場合 SELECT に以前の値を戻す
            if(param.value){
                select.value    =   param.value;
                select.setAttribute('data-previous-value', param.value);
            }else{
                select.value    =   "";
                select.setAttribute('data-previous-value', "");
            }
            document.getElementById(form.id.replace("form","modal")).remove();
        }
</script>
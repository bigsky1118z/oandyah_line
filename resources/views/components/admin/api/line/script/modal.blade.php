<script>
    /** */
        /** */
        function addContent(param){
            if(param.value){
                openModal(param);
            }
            // select に値がない場合、初期状態に戻す
            if(!param.value){
                param.closest("dd").querySelector("button.clearContent").click();
            }
        }
        /** */
        function editContent(param){
            // content-dd に要素がある場合、 select の値を取得し、それに応じた MODAL を開く
            const contentDd =   param.closest("dl").querySelector("dd.content-dd");
            if(contentDd.querySelectorAll("input").length>0){
                // content-dd に収納されているデータの値を values に格納する
                const select    =   param.closest("dl").querySelector("dd.select-dd .addContent");
                const values    =   new Object();
                Array.from(contentDd.querySelectorAll('input, textarea, select')).forEach(node => {
                    if(select.value == "postback" && node.name.includes("[data]") && !node.name.includes("[data][")){
                        node.value.split("&").forEach(data=>{
                            const [key, value] = data.split("=");
                            values[node.name+`[${key}]`] = value;
                        });
                    } else {
                        values[node.name]   =   node.value;
                    }
                });
                openModal(select, values);
            }
        }
        /** */
        function clearContent(param){
            const contentDd =   param.closest("dl").querySelector('dd.content-dd');
            while(contentDd.lastChild){
                contentDd.removeChild(contentDd.lastChild);
            }
            const addContent    =   param.closest("dl").querySelector("dd.select-dd .addContent");
            switch(true){
                case addContent.classList.contains("addMessage"):
                case addContent.classList.contains("addAction"):
                case addContent.classList.contains("addEndpoint"):
                addContent.value    =   "";
                addContent.setAttribute("data-previous-value","");
                    break;
                case addContent.classList.contains("addColumn"):
                    break;
            }
        }
    /** */
        /** PARAM のクラスと値に対応する MODAL を開く 調整済み */
        function openModal(param,values){
            let modal;
            const paramClassList    =   param.classList;
            if(paramClassList.contains("addMessage")){
                modal   =   document.getElementById(`modal-message-object-${param.value.replace(/_/g, "-")}`);
            }
            if(paramClassList.contains("addAction")){
                modal   =   document.getElementById(`modal-action-object-${param.value.replace(/_/g, "-")}`);
            }
            if(paramClassList.contains("addColumn")){
                modal   =   document.getElementById(`modal-column-object-${param.value.replace(/_/g, "-")}`);
            }
            if(paramClassList.contains("addEndpoint")){
                if(param.value =="broadcast"){
                    param.setAttribute('data-previous-value', param.value);     // param に今回の値を変更前の値として記録する
                    return;
                }else{
                    modal   =   document.getElementById(`modal-endpoint-${param.value.replace(/_/g, "-")}`);
                }
            }
            if(paramClassList.contains("addUnit")){
                modal   =   document.getElementById(`modal-unit-${param.value.replace(/_/g, "-")}`);
            }
            if(modal){
                // MODAL を複製する
                const newModal  =   modal.cloneNode(true);
                    // MODAL の display を none から block にする
                    newModal.style.display  =   "block";
                    // MODAL に id を設定する
                    newModal.setAttribute('id', param.id.replace('type','modal'));
                    // MODAL の form に id を設定する
                const form  =   newModal.querySelector('.modal-content form');
                form.setAttribute('id', param.id.replace('type','form'));
                // MODAL 内の 要素の各処理
                Array.from(form.querySelectorAll('input, textarea, select, button')).forEach(node => {
                    if(node.name){
                        // id と name を変換する
                        const newNodeId     =   param.id.replace("type",node.name.replace(/\]/g,"").split("[").join("-"));
                        node.setAttribute('id', newNodeId);
                        const newNodeName   =   param.name.replace("[type]", `[${node.name.replace(/\]/g,"").split("[").join("][")}]`);
                        node.setAttribute('name', newNodeName);
                        const selectDd      =   node.closest("dl").querySelector("dd.select-dd");
                        const contentDd     =   node.closest("dl").querySelector("dd.content-dd");
                        if(values){
                            const value =   values[node.name];
                            if(value){
                                switch(node.type){
                                    case "checkbox":
                                    case "radio":
                                        if(node.value == value){
                                            node.checked = true;
                                        };
                                        break;
                                    default:
                                        node.value = value;
                                }
                            }
                            if(node.classList.contains("addImage")){
                                if(value){
                                    const imageButton   =   selectDd.querySelector("button");
                                    imageButton.textContent  =   "画像キャンセル";
                                    imageButton.setAttribute("onclick", "imageCancelButton(this);");
                                    const img       =   document.createElement("img");
                                    img.setAttribute("src", value);
                                    contentDd.appendChild(img);
                                }
                            }
                            if(node.classList.contains("addAction")){
                                if(value){
                                    // node に前回の値を残す
                                    node.setAttribute("data-previous-value", value);
                                }
                                // object key が action 以降と一致するものを contentDd に挿入する
                                const dls    =   new Array();
                                for(const key in values){
                                    if(key == node.name){
                                        continue;
                                    }
                                    if(key.includes(node.name.replace("[type]",""))){
                                        const dl            =   document.createElement("dl");
                                            dl.classList.add("dl-flex-left");
                                        const titleDt       =   document.createElement("dt");
                                        titleDt.textContent =   key.replace(/\]/g, "").split("[").slice(-1)[0];
                                        const displayDd     =   document.createElement("dd");
                                        displayDd.innerHTML =  values[key].replace(/\n/g,"<br>");
                                        const input =   document.createElement("input");
                                            input.setAttribute("type", "hidden");
                                            input.setAttribute("name", key);
                                            input.setAttribute("value", values[key]);
                                        const inputDd       =   document.createElement("dd");
                                        inputDd.appendChild(input);
                                        dl.appendChild(titleDt);
                                        dl.appendChild(displayDd);
                                        dl.appendChild(inputDd);
                                        dls.push(dl);
                                    }
                                }
                                dls.forEach(dl=>contentDd.appendChild(dl));
                            }
                            if(node.classList.contains("addColumn")){
                                // object key が action 以降と一致するものを contentDd に挿入する
                                const dls   =   new Array();
                                if(contentDd){
                                    for(const key in values){
                                        if(key == node.name){
                                            continue;
                                        }
                                        if(key.includes(node.name.replace("[type]",""))){
                                            const dl            =   document.createElement("dl");
                                            const titleDt       =   document.createElement("dt");
                                            titleDt.textContent =   key.replace(/\]/g, "").split("[").slice(-1)[0];
                                            const displayDd     =   document.createElement("dd");
                                            if(values[key].includes('{{ asset("storage/$channel->channel_name") }}')){
                                                const img   =   document.createElement("img");
                                                img.setAttribute("src", values[key]);
                                                displayDd.appendChild(img);
                                            } else {
                                                displayDd.innerHTML =   values[key].replace(/\n/g,"<br>");
                                            }
                                            const inputDd       =   document.createElement("dd");
                                            const input =   document.createElement("input");
                                                input.setAttribute("type", "hidden");
                                                input.setAttribute("name", key);
                                                input.setAttribute("value", values[key]);
                                            inputDd.appendChild(input);
                                            dl.appendChild(titleDt);
                                            dl.appendChild(displayDd);
                                            dl.appendChild(inputDd);
                                            dls.push(dl);
                                        }
                                    }
                                }
                                dls.forEach(dl=>contentDd.appendChild(dl));
                            }
                        }
                        if(paramClassList.contains("addMessage")){
                            if(param.value == "history"){
                                node.id     =   `${node.id}-${node.value}`;
                                const label =   document.createElement("label");
                                label.textContent   =   node.getAttribute("data-name");
                                label.setAttribute("for", node.id);
                                contentDd.appendChild(label);
                            }
                        }
                        if(paramClassList.contains("addAction")){
                        }
                        if(paramClassList.contains("addColumn")){
                        }
                        if(paramClassList.contains("addEndpoint")){
                            if(param.value == "push"){
                                const label =   document.createElement("label");
                                label.textContent   =   node.getAttribute("data-nickname");
                                label.setAttribute("for", node.id);
                                contentDd.appendChild(label);
                            }
                        }
                    }
                });

                if(paramClassList.contains("addMessage")){
                    if(param.value == "text"){
                    }
                    if(param.value == "image"){
                    }
                    // type template_carousel のときのパラメータ処理
                    if(param.value == "template_carousel"){
                        const configColumnArray  =   [0,0,0,1];
                        if(values){
                            if(values.hasOwnProperty(param.name.replace("type","template][columns][1][thumbnailImageUrl"))){
                                newModal.querySelector("select.config-column-image").value    =   1;
                                form.querySelector("select.carousel-image-aspect-ratio").disabled  =   false;
                                form.querySelector("select.carousel-image-aspect-ratio").required  =   true;
                                form.querySelector("select.carousel-image-size").disabled  =   false;
                                form.querySelector("select.carousel-image-size").required  =   true;
                                configColumnArray[0] =   1;
                            }
                            if(values.hasOwnProperty(param.name.replace("type","template][columns][1][title"))){
                                newModal.querySelector("select.config-column-title").value    =   1;
                                configColumnArray[1] =   1;
                            }
                            if(values.hasOwnProperty(param.name.replace("type","template][columns][1][defaultAction][type"))){
                                newModal.querySelector("select.config-column-default-action").value    =   1;
                                configColumnArray[2] =   1;
                            }
                            if(values.hasOwnProperty(param.name.replace("type","template][columns][1][actions][2][type"))){
                                newModal.querySelector("select.config-column-actions-num").value    =   2;
                                configColumnArray[3] =   2;
                            }
                            if(values.hasOwnProperty(param.name.replace("type","template][columns][1][actions][3][type"))){
                                newModal.querySelector("select.config-column-actions-num").value    =   3;
                                configColumnArray[3] =   3;
                            }
                        }
                        form.querySelectorAll("dd.select-dd button.addContent").forEach(button=>button.setAttribute("data-config-column",configColumnArray.join("-")));
                    }
                }
                if(paramClassList.contains("addAction")){
                    if(param.value == "postback"){
                    }
                }
                if(paramClassList.contains("addColumn")){
                    if(param.value == "carousel"){
                        if(param.hasAttribute("data-config-column")){
                            const [configImage, configTitle, configDefaultAction, configActionsNum]  =   param.getAttribute("data-config-column").split("-");
                            if(configImage==0){
                                newModal.querySelector("dl.carousel-image-url").remove();
                                newModal.querySelector("dl.carousel-image-background-color").remove();
                            }
                            if(configTitle==0){
                                newModal.querySelector("dl.carousel-title").remove();
                            }
                            if(configDefaultAction==0){
                                newModal.querySelector("dl.carousel-default-action").remove();
                            }
                            if(configActionsNum<2){
                                newModal.querySelector("dl.carousel-actions-1").remove();
                            }
                            if(configActionsNum<3){
                                newModal.querySelector("dl.carousel-actions-2").remove();
                            }
                        }
                    }
                    if(param.value == "image_carousel"){                    
                    }
                }
                if(paramClassList.contains("addEndpoint")){
                    if(param.value == "push"){
                    }
                }

                // param に変更前の値が記録させれている場合 button.cancelModal に変更前の値を記録する
                if(param.hasAttribute("data-previous-value")) {
                    const cancelModal   =   newModal.querySelector("button.cancelModal");
                    cancelModal.value   =   param.getAttribute("data-previous-value");
                }
                // param に今回の値を変更前の値として記録する
                param.setAttribute('data-previous-value', param.value);
                // div#modalにdisplay:blockで追加する
                document.querySelector("div#modal").appendChild(newModal);
            }else{
                // MODAL のサンプルがない場合 MODALは開かず select を元の値に戻す
                if(param.hasAttribute("data-previous-value")) {
                    // 変更前の値がある場合 param の値を変更前に戻す
                    param.value =   param.getAttribute("data-previous-value");
                }
                if(!param.hasAttribute("data-previous-value")) {
                    // 変更前の値がない場合 param の値を "" にする
                    param.value =   "";
                }
            }
        }
            /** IMAGE BUTTON */
            /** 画像を選択するウィンドウを開く 調整済み */
            function imageSelectButton(param) {
                const input =   param.closest('dl').querySelector('dd.select-dd input');
                input.value =   null;
                input.setAttribute("type", "file");
                input.click();
            }
            /** 選択されている画像を削除して、選択ボタンを表示する 調整済み */
            function imageCancelButton(param) {
                const input =   param.closest('dl').querySelector('dd.select-dd input');
                input.value =   null;
                input.setAttribute("type", "text");
                const contentDd  =   param.closest("dl").querySelector("dd.content-dd");
                while(contentDd.lastChild){
                    contentDd.removeChild(contentDd.lastChild);
                }
                param.textContent  =   "画像選択";
                param.setAttribute("onclick", "imageSelectButton(this);");
            }
            /** 選択した画像をプレビュー表示する 調整済み */
            function imageSelect(param) {
                const files = param.files;
                if (files.length) {
                    const file  =   files[0];
                    const contentDd =   param.closest("dl").querySelector("dd.content-dd");
                    while(contentDd.lastChild){
                        contentDd.removeChild(contentDd.lastChild);
                    }
                    if(file.size <= 1024 * 1024){
                        const fileReader = new FileReader();
                        const img = document.createElement("img");
                        fileReader.onload   = function () {
                            img.setAttribute("src", this.result);
                        };
                        fileReader.readAsDataURL(file);
                        contentDd.appendChild(img);

                        const imageButton  =   param.closest("dl").querySelector("dd.select-dd button");
                        imageButton.textContent  =   "画像キャンセル";
                        imageButton.setAttribute("onclick", "imageCancelButton(this);");
                    }
                    if(file.size > 1024 * 1024) {
                        contentDd.textContent =   "※画像サイズは1MB以下にしてください";
                    }
                }
            }

            /** カラムの構成を反映させる 調整済み */
            function configColumn(param, config){
                const value =   param.value;
                const num   =   ['image','title','defaultAction','actionsNum'].indexOf(config);
                const form  =   param.closest("div").querySelector("form");
                // configColumn が image のとき、画像のアスペクト比と表示形式を操作する
                if(num == 0){
                    const imageAspectRatio      =   form.querySelector("select.carousel-image-aspect-ratio");
                    const imageSize             =   form.querySelector("select.carousel-image-size");
                    [imageAspectRatio, imageSize].forEach(node => {
                    if(param.value == 0){
                            node.value      =   "";
                            node.required   =   false;
                            node.disabled   =   true;
                            node.closest("dl").classList.add("hidden");
                        }
                        if(param.value == 1){
                            node.required   =   true;
                            node.disabled   =   false;
                            node.closest("dl").classList.remove("hidden");
                        }
                    });
                }
                Array.from(form.querySelectorAll("dd.select-dd button.addContent")).forEach(node=>{
                    if(node.hasAttribute("data-config-column")){
                        const values    =   node.getAttribute("data-config-column").split("-");
                        values[num]     =   param.value;
                        node.setAttribute("data-config-column", values.join("-"));
                    }
                    const contentDd =   node.closest("dl").querySelector("dd.content-dd");
                    if(contentDd.childElementCount > 0){
                        const dl        =   document.createElement("dl");
                        const displayDd =   document.createElement("dd");
                        const inputDd   =   document.createElement("dd");
                        const required  =   document.createElement("input");
                            required.required   =   true;
                            required.setAttribute("type","hidden");
                        dl.appendChild(displayDd);
                        dl.appendChild(inputDd);
                        inputDd.appendChild(required);
                        switch(num) {
                            case(0):
                                const thumbnailImageUrl     =   contentDd.querySelector(`input[name="${node.name.replace("type","thumbnailImageUrl")}"]`);
                                const imageBackgroundColor  =   contentDd.querySelector(`input[name="${node.name.replace("type","imageBackgroundColor")}"]`);
                                if(value==0) {
                                    if(imageUrl){
                                        imageUrl.closest("dl").remove();
                                    }
                                    if(imageBackgroundColor){
                                        imageBackgroundColor.closest("dl").remove();
                                    }
                                }
                                if(value==1){
                                    if(!thumbnailImageUrl){
                                        displayDd.textContent =   "画像を追加してください";
                                        required.setAttribute("name", node.name.replace("type", "thumbnailImageUrl"));
                                        contentDd.append(dl);
                                    }
                                }
                                break;
                            case(1):
                                const title =   contentDd.querySelector(`input[name="${node.name.replace("type","title")}"]`);
                                if(value == 0){
                                    if(title){
                                        title.closest("dl").remove();
                                    }
                                }
                                if(value == 1){
                                    if(!title){
                                        displayDd.textContent   =   "タイトルを追加してください";
                                        required.setAttribute("name", node.name.replace("type", "title"));
                                        contentDd.appendChild(dl);
                                    }
                                }
                                break;
                            case(2):
                                const defaultAction =    contentDd.querySelectorAll(`input[name*="${node.name.replace("type","defaultAction")}"]`);
                                if(value == 0){
                                    if(defaultAction.length > 0){
                                        Array.from(defaultAction).forEach(action=>action.closest("dl").remove());
                                    }
                                }
                                if(value == 1){
                                    if(defaultAction.length == 0){
                                        displayDd.textContent   =   "デフォルトアクションを追加してください";
                                        required.setAttribute("name",node.name.replace("type","defaultAction][type"));
                                        contentDd.appendChild(dl);
                                    }
                                }
                                break;
                            case(3):
                                const actions1  =   contentDd.querySelectorAll(`input[name*="${node.name.replace("type","actions][1")}"]`);
                                const actions2  =   contentDd.querySelectorAll(`input[name*="${node.name.replace("type","actions][2")}"]`);
                                const actions3  =   contentDd.querySelectorAll(`input[name*="${node.name.replace("type","actions][3")}"]`);
                                [actions1, actions2, actions3].forEach((actions, index)=>{
                                    const actionNum =   index + 1;
                                    if(value < actionNum && actions.length > 0){
                                        Array.from(actions).forEach(action=>action.closest("dl").remove());
                                    }
                                    if(value >= actionNum && actions.length == 0){
                                        const actionDl  =   dl.cloneNode(true);
                                        actionDl.querySelector("dd").textContent    =   `アクション${actionNum}を追加してください`;
                                        actionDl.querySelector("input").setAttribute("name",node.name.replace("type",`actions][${actionNum}][type`));
                                        contentDd.appendChild(actionDl);
                                    }
                                });
                                break;
                        }
                    }
                });
            }

        /** MODAL 内で入力された値を content-td に出力する 調整済み */
        function outputModal(param) {
            const form      =   param.closest("div").querySelector("div.modal-content form");
            const select    =   document.getElementById(form.id.replace("form","type"));
            const contentDd =   select.closest("dl").querySelector("dd.content-dd");
            // required がすべて入力されているか validation する
            let isSubmit        =   true;
            let countColumns    =   0;
            const dls           =   new Array();
            // content-td に挿入する処理
            Array.from(form.querySelectorAll("input, textarea, select")).forEach(node => {
                // required が一つでも入力されていない場合 isSubmit を flase にする
                if(node.required && !node.value){
                    isSubmit  =   false;
                    node.setAttribute("placeholder","※必須");
                }
                if(node.value){
                    const dl        =   document.createElement("dl");
                        dl.classList.add("dl-flex-left");
                    const titleDt   =   document.createElement("dt");
                    const displayDd =   document.createElement("dd");
                    const inputDd   =   document.createElement("dd");
                    const img       =   document.createElement("img");
                    const input     =   document.createElement("input");
                        input.setAttribute("type", "hidden");
                        input.setAttribute("name", node.name);
                        input.setAttribute("value", node.value);
                    // input を 変換して content-td に挿入する
                    if(node.type== "file" && node.accept == "image/*"){
                        // input が file で accept が image/* のとき
                        const files     =   node.files;
                        const response  =   uploadImageFile(files);
                        response.then(data=>{
                            titleDt.innerHTML =   node.name.replace(/\]/g, "").split("[").slice(-1)[0];
                            // content-td に挿入するための img要素を作成する
                            const fileName  =   data.file_name;
                            img.setAttribute("src", "/storage/{{ $channel->channel_name }}/" + fileName);
                            displayDd.appendChild(img);
                            input.setAttribute("value", `{{ asset("storage/$channel->channel_name") }}/${fileName}`);
                        });
                    } else if(node.value.includes('{{ asset("storage/$channel->channel_name") }}')) {
                        // img タグで表示したいとき
                        titleDt.innerHTML =   node.name.replace(/\]/g, "").split("[").slice(-1)[0];
                        // MESSAGE TYPE = image で編集を選択してるとき
                        img.setAttribute("src", node.value);
                        displayDd.appendChild(img);
                    } else if(node.type=="checkbox") {
                        if(node.checked){
                            if(node.hasAttribute("data-nickname")){
                                displayDd.textContent   =   node.getAttribute("data-nickname");
                            } else if(node.name.includes("user_id") && node.value == "user_id") {
                                displayDd.textContent   =   "ユーザーID";
                            } else {
                                displayDd.textContent   =   "check";
                            }
                        }
                        if(!node.checked){
                            return;
                        }                        
                    } else if(node.type=="radio") {
                        if(node.checked){
                            if(select.value == "history"){
                                const historyMessage = getHistoryMessage(node.value);
                                historyMessage.then(data => {
                                    let type = "", templateType = "";
                                    for(const key in data) {
                                        const value = data[key];
                                        if(key == "type") {
                                            type = value;
                                            continue;
                                        } else if(key.includes("[data")){
                                            value.split("&").forEach(datum=>{
                                                const [left, right] =   datum.split("=");
                                                const cloneDl           =   dl.cloneNode(true);
                                                const cloneTitleDt      =   titleDt.cloneNode(true);
                                                    cloneTitleDt.textContent = left;
                                                const cloneDisplayDd    =   displayDd.cloneNode(true);
                                                    cloneDisplayDd.textContent  =   right;
                                                const cloneInputDd      =   inputDd.cloneNode(true);
                                                const cloneInput        =   input.cloneNode(true);
                                                    cloneInput.setAttribute("name", cloneInput.name.replace("history", key+ "][" + left) );
                                                    cloneInput.setAttribute("value", right);        
                                                cloneDl.appendChild(cloneTitleDt);
                                                cloneDl.appendChild(cloneDisplayDd);
                                                cloneDl.appendChild(cloneInputDd);
                                                cloneInputDd.appendChild(cloneInput);
                                                dls.push(cloneDl);
                                            });
                                            continue;
                                        } else {
                                            if(key == "template][type"){
                                                templateType = value;
                                            }
                                            const cloneDl           =   dl.cloneNode(true);
                                            const cloneTitleDt      =   titleDt.cloneNode(true);
                                                if(key.includes("][")){
                                                    cloneTitleDt.textContent = key.split("][").slice(-1);
                                                } else {
                                                    cloneTitleDt.textContent = key;
                                                }
                                            const cloneDisplayDd    =   displayDd.cloneNode(true);
                                                cloneDisplayDd.textContent  =   value;
                                            const cloneInputDd      =   inputDd.cloneNode(true);
                                            const cloneInput        =   input.cloneNode(true);
                                                cloneInput.setAttribute("name", cloneInput.name.replace("history", key));
                                                cloneInput.setAttribute("value", value);
    
                                            cloneDl.appendChild(cloneTitleDt);
                                            cloneDl.appendChild(cloneDisplayDd);
                                            cloneDl.appendChild(cloneInputDd);
                                            cloneInputDd.appendChild(cloneInput);
                                            dls.push(cloneDl);
                                        }
                                    }
                                    const selectValue = templateType ? `${type}_${templateType}` : type;
                                    select.value = selectValue;
                                    select.setAttribute("data-previous-value",selectValue);
                                    while(contentDd.lastChild){
                                        contentDd.removeChild(contentDd.lastChild);
                                    }
                                    // 配列 dls 内の dl を content-td に追加する
                                    dls.forEach(dl=>contentDd.appendChild(dl));
                                    // MODAL を削除する
                                    document.getElementById(form.id.replace("form","modal")).remove();
                                });
                            }
                            // content-td 内にある要素をすべて削除する
                            isSubmit = false;
                            return;
                        }
                        if(!node.checked){
                            return;
                        }
                    } else if(node.name.includes("customAggregationUnits")) {
                        displayDd.innerHTML =  node.value;
                    } else {
                        titleDt.textContent =   node.name.replace(/\]/g, "").split("[").slice(-1)[0];
                        displayDd.innerHTML =  node.value.replace(/\n/g,"<br>");
                    }
                    if(select.classList.contains("addMessage")){
                        displayDd.classList.add("message-object", select.value);

                        if(select.value.includes("carousel")) {
                            if(node.name.includes("[template][columns]")){
                                countColumns++;
                            }
                        }
                    // 追加バリデーション用の条件分岐
                    } 
                    dl.appendChild(titleDt);
                    dl.appendChild(displayDd);
                    dl.appendChild(inputDd);
                    inputDd.appendChild(input);
                    dls.push(dl);
                }
            });
            // 追加バリデーション
            if(select.classList.contains("addEndpoint") && select.value =="push" && !dls.length){
                isSubmit  =   false;
            }
            if(select.classList.contains("addMessage") && select.value.includes("carousel") && countColumns==0){
                isSubmit  =   false;
            }
            // validate が true の場合、 MODAL を削除する
            if(isSubmit){
                // content-td 内にある要素をすべて削除する
                while(contentDd.lastChild){
                    contentDd.removeChild(contentDd.lastChild);
                }
                // 配列 dls 内の dl を content-td に追加する
                dls.forEach(dl=>contentDd.appendChild(dl));
                // MODAL を削除する
                document.getElementById(form.id.replace("form","modal")).remove();
            }
            // validate が false の場合、画面遷移しない
            if(!isSubmit){
                console.log('non');
            }
        }
            /** storage に file をアップロードする */
            async function uploadImageFile(files) {
                const file = files[0];
                let result = null;
                try {
                    const formData  =   new FormData();
                    formData.append("file", file);
                    const options   =   {
                        "method"    :   "post",
                        "headers"   :   {
                            "enctype"   :   "multipart/form-data",
                        },
                        "body"      :   formData,
                    };
                    const response = await fetch("/api/line/{{ $channel->channel_name }}/image", options);
                    if (response.ok) {
                        result  =   await response.json();
                    } else {
                        throw new Error('HTTP status code: ' + response.status);
                    }
                } catch (error) {
                    console.error(error);
                }
                return result;
            }
            /** storage に file をアップロードする */
            async function getHistoryMessage(id) {
                let result = null;
                try {
                    const options   =   {
                        "method"    :   "post",
                    };
                    const response = await fetch(`/api/line/{{ $channel->channel_name }}/message/${id}`, options);
                    if (response.ok) {
                        result  =   await response.json();
                    } else {
                        throw new Error('HTTP status code: ' + response.status);
                    }
                } catch (error) {
                    console.error(error);
                }
                return result;
            }
        /** MODAL を開く前の状態に戻す */
        function cancelModal(param){
            // form の id　から MODAL の展開元を取得する
            const form      =   param.closest("div").querySelector("div.modal-content form");
            const select    =   document.getElementById(form.id.replace("form","type"));
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
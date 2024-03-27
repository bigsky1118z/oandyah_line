<script>
            /** MESSAGE MODAL */
            /** MESSAGES TYPE SELECT の値に対応する MODAL を開く 調整済み */
            function openMessageModal(param, values) {
                // MODAL のサンプルを取得する
                const modal =   document.getElementById(`modal-message-object-${param.value.replace(/_/g, "-")}`);
                if(modal){
                    // // MODAL のサンプルがある場合 MODAL を CLONE して開く
                    // const newModal  =   modal.cloneNode(true);
                    // newModal.style.display  =   "block";
                    // newModal.setAttribute('id', param.id.replace('type','modal'));
                    // newModal.querySelector('.modal-content form').setAttribute('id', param.id.replace('type','form'));

                    // // type template_carousel のときのパラメータ処理
                    // const configColumnArray  =   [0,0,0,1];
                    // if(param.value == "template_carousel" && values){
                    //     if(values.hasOwnProperty(param.id.replace("type","template-columns-1-imageUrl").split("-").map(value=>value + "]").join("[").replace(/\]/,""))){
                    //         newModal.querySelector("select.config-column-image").value    =   1;
                    //         newModal.querySelector('.modal-content form').querySelector("select.carousel-image-aspect-ratio").disabled  =   false;
                    //         newModal.querySelector('.modal-content form').querySelector("select.carousel-image-aspect-ratio").required  =   true;
                    //         newModal.querySelector('.modal-content form').querySelector("select.carousel-image-size").disabled  =   false;
                    //         newModal.querySelector('.modal-content form').querySelector("select.carousel-image-size").required  =   true;
                    //         configColumnArray[0] =   1;
                    //     }
                    //     if(values.hasOwnProperty(param.id.replace("type","template-columns-1-title").split("-").map(value=>value + "]").join("[").replace(/\]/,""))){
                    //         newModal.querySelector("select.config-column-title").value    =   1;
                    //         configColumnArray[1] =   1;
                    //     }
                    //     if(values.hasOwnProperty(param.id.replace("type","template-columns-1-defaultAction-type").split("-").map(value=>value + "]").join("[").replace(/\]/,""))){
                    //         newModal.querySelector("select.config-column-default-action").value    =   1;
                    //         configColumnArray[2] =   1;
                    //     }
                    //     if(values.hasOwnProperty(param.id.replace("type","template-columns-1-actions-2-type").split("-").map(value=>value + "]").join("[").replace(/\]/,""))){
                    //         newModal.querySelector("select.config-column-actions-num").value    =   2;
                    //         configColumnArray[3] =   2;
                    //     }
                    //     if(values.hasOwnProperty(param.id.replace("type","template-columns-1-actions-3-type").split("-").map(value=>value + "]").join("[").replace(/\]/,""))){
                    //         newModal.querySelector("select.config-column-actions-num").value    =   3;
                    //         configColumnArray[3] =   3;
                    //     }
                    // }
                    // MODAL内のinput,textarea,selectのnameとidを変換する
                    // values がある場合はそれぞれ入力する
                    Array.from(newModal.querySelector(".modal-content form").querySelectorAll('input, textarea, select, button')).forEach(node => {
                        if(node.name){
                            // id と name を変換する
                            const newNodeId     =   param.id.replace("type",node.name.replace(/\]/g,"").split("[").join("-"));
                            node.setAttribute('id', newNodeId);
                            const newNodeName   =   param.name.replace("[type]", `[${node.name.replace(/\]/g,"").split("[").join("][")}]`);
                            node.setAttribute('name', newNodeName);

                            // // type=template_carousel のときの追加処理
                            // if(param.value == "template_carousel" && node.hasAttribute("data-config-column")){
                            //     node.setAttribute("data-config-column", configColumnArray.join("-"));
                            // }
                            // // valueが与えられている場合、代入する
                            // if(values && values[node.name]){
                            //     node.value  =   values[node.name];
                            // }
                            // type=imageのときの追加処理
                            // if(values && values[node.name] && values[node.name].includes('{{ asset("storage/$channel->channel_name") }}')){
                            //     const dd_p  =   node.closest("dd").querySelector("p");
                            //     if(dd_p){
                            //         const img = document.createElement("img");
                            //         img.setAttribute("width", "auto");
                            //         img.setAttribute("height", 200);
                            //         img.setAttribute("src", values[node.name]);
                            //         dd_p.appendChild(img);
                            //     }
                            //     const dd_button =   node.closest("dd").querySelector("button");
                            //     if(dd_button){
                            //         dd_button.textContent  =   "画像キャンセル";
                            //         dd_button.setAttribute("onclick", "imageCancelButton(this);");
                            //     }
                            // }
                            // // type=template かつ carousel 以外の時の追加処理
                            // if(values && values[node.name] && (node.name.includes('action') || node.name.includes('Action'))){
                            //     // action select に前回の値を残す
                            //     node.setAttribute("data-previous-value", values[node.name]);
                            //     // object key が action 以降と一致するものを contentDd に挿入する
                            //     const contentDd =   node.closest("dl").querySelector("dd.content-dd");
                            //     const labels    =   new Array();
                            //     if(contentDd){
                            //         for(const key in values){
                            //             if(key.includes(node.name.replace("[type]","")) && key != node.name){
                            //                 const label     =   document.createElement("label");
                            //                 label.innerHTML =   key.replace(/\]/g, "").split("[").slice(-1)[0] + ":";
                            //                 label.innerHTML +=  values[key].replace(/\n/g,"<br>");
                            //                 const input =   document.createElement("input");
                            //                     input.setAttribute("type", "hidden");
                            //                     input.setAttribute("name", key);
                            //                     input.setAttribute("value", values[key]);
                            //                 label.appendChild(input);
                            //                 labels.push(label);
                            //             }
                            //         }
                            //     }
                            //     labels.forEach(label=>contentDd.appendChild(label));
                            // }
                            // type=template かつ carousel の時の追加処理
                            if(values && !values[node.name] && node.name.includes('column') && node.name.includes('type')){
                                // object key が action 以降と一致するものを contentDd に挿入する
                                const contentDd =   node.closest("dl").querySelector("dd.content-dd");
                                const labels    =   new Array();
                                if(contentDd){
                                    for(const key in values){
                                        if(key.includes(node.name.replace("[type]","")) && key != node.name){
                                            const label     =   document.createElement("label");
                                            label.innerHTML =   key.replace(/\]/g, "").split("[").slice(-1)[0] + ":";
                                            if(values[key].includes('{{ asset("storage/$channel->channel_name") }}')) {
                                                // MESSAGE TYPE = image で編集を選択してるとき
                                                const img   =   document.createElement("img");
                                                    img.setAttribute("src", values[key]);
                                                label.appendChild(img);
                                                const input =   document.createElement("input");
                                                    input.setAttribute("type", "hidden");
                                                    input.setAttribute("name", key);
                                                    input.setAttribute("value", values[key]);
                                                label.appendChild(input);
                                            } else {
                                                label.innerHTML +=  values[key].replace(/\n/g,"<br>");
                                                const input =   document.createElement("input");
                                                    input.setAttribute("type", "hidden");
                                                    input.setAttribute("name", key);
                                                    input.setAttribute("value", values[key]);
                                                label.appendChild(input);
                                            }

                                            labels.push(label);
                                        }
                                    }
                                }
                                labels.forEach(label=>contentDd.appendChild(label));
                            }
                        }
                    });
                    // // select に data-previous-value がある場合、キャンセルボタンに value を設定する
                    // if(param.hasAttribute("data-previous-value")) {
                    //     const cancelMessageModal  =   newModal.querySelector("button.cancelMessageModal");
                    //     cancelMessageModal.value  =   param.getAttribute("data-previous-value");
                    // }

                    // // div#modalにdisplay:blockで追加する
                    // document.querySelector("div#modal").appendChild(newModal);

                    // param.setAttribute('data-previous-value', param.value);
                // } else {
                    // // MODAL のサンプルがない場合 MODALは開かず select を元の値に戻す
                    // if(param.hasAttribute("data-previous-value")) {
                    //     param.value =   param.getAttribute("data-previous-value");
                    // }
                    // if(!param.hasAttribute("data-previous-value")) {
                    //     param.value =   "";
                    // }
                }
            }
            // /** MODAL 内で入力された値を content-td に出力する 調整済み */
            // function outputMessageModal(param) {
            //     const form      =   param.closest("div").querySelector("div.modal-content form");
            //     const select    =   document.getElementById(form.id.replace("form","type"));
            //     // required がすべて入力されているか validation する
            //     let isValidate  =   true;
            //     const labels    =   new Array();
            //     // content-td に挿入する処理
            //     Array.from(form.querySelectorAll("input, textarea, select")).forEach(node => {
            //         // required が一つでも入力されていない場合 isValidate を flase にする
            //         if(node.required && !node.value){
            //             isValidate  =   false;
            //             node.setAttribute("placeholder","※必須");
            //         }

            //         if(node.value){
            //             const label     =   document.createElement("label");
            //             label.innerHTML =   node.name.replace(/\]/g, "").split("[").slice(-1)[0] + ":";
            //             // input を 変換して content-td に挿入する
            //             if(node.type=="file"){
            //                 // MESSAGE TYPE = image で新規画像を選択してるとき
            //                 const files =   node.files;
            //                 if(files) {
            //                     const file      =   files[0];
            //                     // fetch を使って Storage に formData を送信する
            //                     const formData  =   new FormData();
            //                     formData.append("file",file);
            //                     const options   =   {
            //                         "method"    :   "post",
            //                         "headers"   :   {
            //                             "enctype"   :   "multipart/form-data",
            //                         },
            //                         "body"      :   formData,
            //                     };
            //                     fetch("/api/line/{{ $channel->channel_name }}/image", options)
            //                     .then(response => {
            //                         if (response.ok) {
            //                             return response.json();
            //                         } else {
            //                             console.error('画像の削除に失敗しました');
            //                             throw new Error('HTTP status code: ' + response.status);
            //                         }
            //                     })
            //                     .then(data => {
            //                         // content-td に挿入するための img要素を作成する
            //                         const fileName  =   data.file_name;
            //                         const img   =   document.createElement("img");
            //                             img.setAttribute("src", "/storage/{{ $channel->channel_name }}/" + fileName);
            //                         label.appendChild(img);
            //                         // content-td に挿入するための input[type=hidden]要素を作成する
            //                         const input =   document.createElement("input");
            //                             input.setAttribute("type", "hidden");
            //                             input.setAttribute("name", node.name);
            //                             input.setAttribute("value", `{{ asset("storage/$channel->channel_name") }}/${fileName}`);
            //                         label.appendChild(input);
            //                     })
            //                     .catch(error => {
            //                         console.error('通信エラーが発生しました', error);
            //                     });
            //                 }
            //             } else if(node.value.includes('{{ asset("storage/$channel->channel_name") }}')) {
            //                 // MESSAGE TYPE = image で編集を選択してるとき
            //                 const img   =   document.createElement("img");
            //                     img.setAttribute("src", node.value);
            //                 label.appendChild(img);
            //                 const input =   document.createElement("input");
            //                     input.setAttribute("type", "hidden");
            //                     input.setAttribute("name", node.name);
            //                     input.setAttribute("value", node.value);
            //                 label.appendChild(input);
            //             } else {
            //                 label.innerHTML +=  node.value.replace(/\n/g,"<br>");
            //                 const input =   document.createElement("input");
            //                     input.setAttribute("type", "hidden");
            //                     input.setAttribute("name", node.name);
            //                     input.setAttribute("value", node.value);
            //                 label.appendChild(input);
            //             }
            //             // label を 配列 labels に挿入する
            //             labels.push(label);
            //         }
            //     });
            //     // validate が true の場合、 MODAL を削除する
            //     if(isValidate){
            //         // content-td 内にある要素をすべて削除する
            //         const contentDd =   select.closest("dl").querySelector("dd.content-dd");
            //         while(contentDd.lastChild){
            //             contentDd.removeChild(contentDd.lastChild);
            //         }
            //         // 配列 labels 内の label を content-td に追加する
            //         labels.forEach(label=>contentDd.appendChild(label));
            //         document.getElementById(form.id.replace("form","modal")).remove();
            //     }
            //     if(!isValidate){
            //         console.log('validate');
            //     }
            // }
            // /** MODAL を開く前の状態に戻す 再確認 */
            // function cancelMessageModal(param) {
            //     // form の id　から MESSGAE TYPE の SELECT を取得する
            //     const form      =   param.closest("div").querySelector("div.modal-content form");
            //     const select    =   document.getElementById(form.id.replace("form","type"));
            //     // キャンセルボタン に 以前のSELECTの値が value としてある場合 SELECT に以前の値を戻す
            //     if(param.value){
            //         select.value    =   param.value;
            //         select.setAttribute('data-previous-value', param.value);
            //     }else{
            //         select.value    =   "";
            //         select.setAttribute('data-previous-value', "");
            //     }
            //     document.getElementById(form.id.replace("form","modal")).remove();
            // }

        /** ACTION MODAL */
            // /** ACTION TYPE SELECT の値に対応する MODAL を開く 調整済み */
            // function openActionModal(param, values) {
            //     // MODAL のサンプルを取得する
            //     const modal =   document.getElementById(`modal-action-object-${param.value.replace(/_/g, "-")}`);
            //     if(modal){
            //         // MODAL のサンプルがある場合 MODAL を CLONE して開く
            //         const newModal  =   modal.cloneNode(true);
            //         newModal.style.display  =   "block";
            //         newModal.setAttribute('id', param.id.replace('type','modal'));
            //         newModal.querySelector('.modal-content form').setAttribute('id', param.id.replace('type','form'));

            //         // MODAL内のinput,textarea,selectのnameとidを変換する
            //         // values がある場合はそれぞれ入力する
            //         Array.from(newModal.querySelector(".modal-content form").querySelectorAll('input, textarea, select, button')).forEach(node => {
            //             if(node.name){
            //                 // id と name を変換する
            //                 const newNodeId     =   param.id.replace("type",node.name.replace(/\]/g,"").split("[").join("-"));
            //                 node.setAttribute('id', newNodeId);
            //                 const newNodeName   =   param.name.replace("[type]", `[${node.name.replace(/\]/g,"").split("[").join("][")}]`);
            //                 node.setAttribute('name', newNodeName);

            //                 // valueが与えられている場合、代入する
            //                 if(values && values[node.name]){
            //                     node.value  =   values[node.name];
            //                 }
            //             }
            //         });
            //         // select に data-previous-value がある場合、キャンセルボタンに value を設定する
            //         if(param.hasAttribute("data-previous-value")) {
            //             const cancelMessageModal  =   newModal.querySelector("button.cancelActionModal");
            //             cancelMessageModal.value  =   param.getAttribute("data-previous-value");
            //         }
            //         // div#modalにdisplay:blockで追加する
            //         document.querySelector("div#modal").appendChild(newModal);
            //         param.setAttribute('data-previous-value', param.value);
            //     } else {
            //         // MODAL のサンプルがない場合 MODALは開かず select を元の値に戻す
            //         if(param.hasAttribute("data-previous-value")) {
            //             param.value =   param.getAttribute("data-previous-value");
            //         }
            //         if(!param.hasAttribute("data-previous-value")) {
            //             param.value =   "";
            //         }
            //     }
            // }
            // /** MODAL 内で入力された値を content-td に出力する 調整済み */
            // function outputActionModal(param) {
            //     const form      =   param.closest("div").querySelector("div.modal-content form");
            //     const select    =   document.getElementById(form.id.replace("form","type"));
            //     // required がすべて入力されているか validation する
            //     let isValidate  =   true;
            //     const labels    =   new Array();
            //     // content-td に挿入する処理
            //     Array.from(form.querySelectorAll("input, textarea, select")).forEach(node => {
            //         // required が一つでも入力されていない場合 isValidate を flase にする
            //         if(node.required && !node.value){
            //             isValidate  =   false;
            //             node.setAttribute("placeholder","※必須");
            //         }
            //         if(node.value){
            //             const label     =   document.createElement("label");
            //             label.innerHTML =   node.name.replace(/\]/g, "").split("[").slice(-1)[0] + ":";
            //             // input を 変換して content-td に挿入する
            //             if(node.type=="file"){
            //                 // Action TYPE = image で新規画像を選択してるとき
            //                 const files =   node.files;
            //                 if(files) {
            //                     const file      =   files[0];
            //                     // fetch を使って Storage に formData を送信する
            //                     const formData  =   new FormData();
            //                     formData.append("file",file);
            //                     const options   =   {
            //                         "method"    :   "post",
            //                         "headers"   :   {
            //                             "enctype"   :   "multipart/form-data",
            //                         },
            //                         "body"      :   formData,
            //                     };
            //                     fetch("/api/line/{{ $channel->channel_name }}/image", options)
            //                     .then(response => {
            //                         if (response.ok) {
            //                             return response.json();
            //                         } else {
            //                             console.error('画像の削除に失敗しました');
            //                             throw new Error('HTTP status code: ' + response.status);
            //                         }
            //                     })
            //                     .then(data => {
            //                         // content-td に挿入するための img要素を作成する
            //                         const fileName  =   data.file_name;
            //                         const img   =   document.createElement("img");
            //                             img.setAttribute("src", "/storage/{{ $channel->channel_name }}/" + fileName);
            //                         label.appendChild(img);
            //                         // content-td に挿入するための input[type=hidden]要素を作成する
            //                         const input =   document.createElement("input");
            //                             input.setAttribute("type", "hidden");
            //                             input.setAttribute("name", node.name);
            //                             input.setAttribute("value", `{{ asset("storage/$channel->channel_name") }}/${fileName}`);
            //                         label.appendChild(input);
            //                     })
            //                     .catch(error => {
            //                         console.error('通信エラーが発生しました', error);
            //                     });
            //                 }
            //             } else if(node.type=="text" && node.value.includes('{{ asset("storage/$channel->channel_name") }}')) {
            //                 // Action TYPE = image で編集を選択してるとき
            //                 const img   =   document.createElement("img");
            //                     img.setAttribute("src", node.value);
            //                 label.appendChild(img);
            //                 const input =   document.createElement("input");
            //                     input.setAttribute("type", "hidden");
            //                     input.setAttribute("name", node.name);
            //                     input.setAttribute("value", node.value);
            //                 label.appendChild(input);
            //             } else {
            //                 label.innerHTML +=  node.value.replace(/\n/g,"<br>");
            //                 const input =   document.createElement("input");
            //                     input.setAttribute("type", "hidden");
            //                     input.setAttribute("name", node.name);
            //                     input.setAttribute("value", node.value);
            //                 label.appendChild(input);
            //             }
            //             // label を 配列 labels に挿入する
            //             labels.push(label);
            //         }
            //     });
            //     // validate が true の場合、 MODAL を削除する
            //     if(isValidate){
            //         // content-td 内にある要素をすべて削除する
            //         const contentDd =   select.closest("dl").querySelector("dd.content-dd");
            //         while(contentDd.lastChild){
            //             contentDd.removeChild(contentDd.lastChild);
            //         }
            //         // 配列 labels 内の label を content-td に追加する
            //         labels.forEach(label=>contentDd.appendChild(label));
            //         document.getElementById(form.id.replace("form","modal")).remove();
            //     }
            //     if(!isValidate){
            //         console.log('validate');
            //     }
            // }
            // /** MODAL を開く前の状態に戻す 調整済み */
            // function cancelActionModal(param) {
            //     // form の id　から MESSGAE TYPE の SELECT を取得する
            //     const form      =   param.closest("div").querySelector("div.modal-content form");
            //     const select    =   document.getElementById(form.id.replace("form","type"));
            //     // キャンセルボタン に 以前のSELECTの値が value としてある場合 SELECT に以前の値を戻す
            //     if(param.value){
            //         select.value    =   param.value;
            //         select.setAttribute('data-previous-value', param.value);
            //     }else{
            //         select.value    =   "";
            //         select.setAttribute('data-previous-value', "");
            //     }
            //     document.getElementById(form.id.replace("form","modal")).remove();
            // }

        /** COLUMN MODAL */
            // /** COLUMNS TYPE SELECT の値に対応する MODAL を開く 編集前 */
            // function openColumnModal(param, values) {
            //     // MODAL のサンプルを取得する
            //     const modal =   document.getElementById(`modal-column-object-${param.value.replace(/_/g, "-")}`);
            //     if(modal){
            //         // // MODAL のサンプルがある場合 MODAL を CLONE して開く
            //         // const newModal  =   modal.cloneNode(true);
            //         // newModal.style.display  =   "block";
            //         // newModal.setAttribute('id', param.id.replace('type','modal'));
            //         // newModal.querySelector('.modal-content form').setAttribute('id', param.id.replace('type','form'));
            //         // if(param.hasAttribute("data-config-column")){
            //         //     const [configImage, configTitle, configDefaultAction, configActionsNum]  =   param.getAttribute("data-config-column").split("-");
            //         //     if(configImage==0){
            //         //         newModal.querySelector("dl.carousel-image-url").remove();
            //         //         newModal.querySelector("dl.carousel-image-background-color").remove();
            //         //     }
            //         //     if(configTitle==0){
            //         //         newModal.querySelector("dl.carousel-title").remove();
            //         //     }
            //         //     if(configDefaultAction==0){
            //         //         newModal.querySelector("dl.carousel-default-action").remove();
            //         //     }
            //         //     if(configActionsNum<2){
            //         //         newModal.querySelector("dl.carousel-actions-2").remove();
            //         //     }
            //         //     if(configActionsNum<3){
            //         //         newModal.querySelector("dl.carousel-actions-3").remove();
            //         //     }
            //         // }
            //         // MODAL内のinput,textarea,selectのnameとidを変換する
            //         // values がある場合はそれぞれ入力する
            //         Array.from(newModal.querySelector(".modal-content form").querySelectorAll('input, textarea, select, button')).forEach(node => {
            //             if(node.name){
            //                 // id と name を変換する
            //                 const newNodeId     =   param.id.replace("type",node.name.replace(/\]/g,"").split("[").join("-"));
            //                 node.setAttribute('id', newNodeId);
            //                 const newNodeName   =   param.name.replace("[type]", `[${node.name.replace(/\]/g,"").split("[").join("][")}]`);
            //                 node.setAttribute('name', newNodeName);

            //                 // valueが与えられている場合、代入する
            //                 if(values && values[node.name]){
            //                     node.value  =   values[node.name];

            //                     // type=imageのときの追加処理
            //                     if(values[node.name].includes('{{ asset("storage/$channel->channel_name") }}')){
            //                         const dd_p   =   node.closest("dd").querySelector("p");
            //                         if(dd_p){
            //                             const img = document.createElement("img");
            //                             img.setAttribute("width", "auto");
            //                             img.setAttribute("height", 200);
            //                             img.setAttribute("src", values[node.name]);
            //                             dd_p.appendChild(img);
            //                         }
            //                         const dd_button  =   node.closest("dd").querySelector("button");
            //                         if(dd_button){
            //                             dd_button.textContent  =   "画像キャンセル";
            //                             dd_button.setAttribute("onclick", "imageCancelButton(this);");
            //                         }
            //                     }
            //                     // type=template の時の追加処理
            //                     if(node.name.includes('action') || node.name.includes('Action')){
            //                         node.setAttribute("data-previous-value", values[node.name]);
            //                         const contentDd =   node.closest("dl").querySelector("dd.content-dd");
            //                         const labels    =   new Array();
            //                         if(contentDd){
            //                             for(const key in values){
            //                                 if(key.includes(node.name.replace("[type]","")) && key != node.name){
            //                                     const label     =   document.createElement("label");
            //                                     label.innerHTML =   key.replace(/\]/g, "").split("[").slice(-1)[0] + ":";
            //                                     label.innerHTML +=  values[key].replace(/\n/g,"<br>");
            //                                     const input =   document.createElement("input");
            //                                         input.setAttribute("type", "hidden");
            //                                         input.setAttribute("name", key);
            //                                         input.setAttribute("value", values[key]);
            //                                     label.appendChild(input);
            //                                     labels.push(label);
            //                                 }
            //                             }
            //                         }
            //                         labels.forEach(label=>contentDd.appendChild(label));
            //                     }
            //                 }
            //             }
            //         });

            //         // select に data-previous-value がある場合、キャンセルボタンに value を設定する
            //         if(param.hasAttribute("data-previous-value")) {
            //             const cancelColumnModal  =   newModal.querySelector("button.cancelColumnModal");
            //             cancelColumnModal.value  =   param.getAttribute("data-previous-value");
            //         }
            //         // div#modalにdisplay:blockで追加する
            //         document.querySelector("div#modal").appendChild(newModal);
            //         param.setAttribute('data-previous-value', param.value);
            //         return true;
            //     } else {
            //         return false;
            //     }
            // }
            // /** MODAL 内で入力された値を content-td に出力する 調整済み */
            // function outputColumnModal(param) {
            //     const form      =   param.closest("div").querySelector("div.modal-content form");
            //     const select    =   document.getElementById(form.id.replace("form","type"));
            //     // required がすべて入力されているか validation する
            //     let isValidate  =   true;
            //     const labels    =   new Array();
            //     // content-td に挿入する処理
            //     Array.from(form.querySelectorAll("input, textarea, select")).forEach(node => {
            //         // required が一つでも入力されていない場合 isValidate を flase にする
            //         if(node.required && !node.value){
            //             isValidate  =   false;
            //             node.setAttribute("placeholder","※必須");
            //         }

            //         if(node.value){
            //             const label     =   document.createElement("label");
            //             label.innerHTML =   node.name.replace(/\]/g, "").split("[").slice(-1)[0] + ":";
            //             // input を 変換して content-td に挿入する
            //             if(node.type=="file"){
            //                 // Column TYPE = image で新規画像を選択してるとき
            //                 const files =   node.files;
            //                 if(files) {
            //                     const file      =   files[0];
            //                     // fetch を使って Storage に formData を送信する
            //                     const formData  =   new FormData();
            //                     formData.append("file",file);
            //                     const options   =   {
            //                         "method"    :   "post",
            //                         "headers"   :   {
            //                             "enctype"   :   "multipart/form-data",
            //                         },
            //                         "body"      :   formData,
            //                     };
            //                     fetch("/api/line/{{ $channel->channel_name }}/image", options)
            //                     .then(response => {
            //                         if (response.ok) {
            //                             return response.json();
            //                         } else {
            //                             console.error('画像の削除に失敗しました');
            //                             throw new Error('HTTP status code: ' + response.status);
            //                         }
            //                     })
            //                     .then(data => {
            //                         // content-td に挿入するための img要素を作成する
            //                         const fileName  =   data.file_name;
            //                         const img   =   document.createElement("img");
            //                             img.setAttribute("src", "/storage/{{ $channel->channel_name }}/" + fileName);
            //                         label.appendChild(img);
            //                         // content-td に挿入するための input[type=hidden]要素を作成する
            //                         const input =   document.createElement("input");
            //                             input.setAttribute("type", "hidden");
            //                             input.setAttribute("name", node.name);
            //                             input.setAttribute("value", `{{ asset("storage/$channel->channel_name") }}/${fileName}`);
            //                         label.appendChild(input);
            //                     })
            //                     .catch(error => {
            //                         console.error('通信エラーが発生しました', error);
            //                     });
            //                 }
            //             } else if(node.type=="text" && node.value.includes('{{ asset("storage/$channel->channel_name") }}')) {
            //                 // Column TYPE = image で編集を選択してるとき
            //                 const img   =   document.createElement("img");
            //                     img.setAttribute("src", node.value);
            //                 label.appendChild(img);
            //                 const input =   document.createElement("input");
            //                     input.setAttribute("type", "hidden");
            //                     input.setAttribute("name", node.name);
            //                     input.setAttribute("value", node.value);
            //                 label.appendChild(input);
            //             } else {
            //                 label.innerHTML +=  node.value.replace(/\n/g,"<br>");
            //                 const input =   document.createElement("input");
            //                     input.setAttribute("type", "hidden");
            //                     input.setAttribute("name", node.name);
            //                     input.setAttribute("value", node.value);
            //                 label.appendChild(input);
            //             }
            //             // label を 配列 labels に挿入する
            //             labels.push(label);
            //         }
            //     });
            //     // validate が true の場合、 MODAL を削除する
            //     if(isValidate){
            //         // content-td 内にある要素をすべて削除する
            //         const contentDd =   select.closest("dl").querySelector("dd.content-dd");
            //         while(contentDd.lastChild){
            //             contentDd.removeChild(contentDd.lastChild);
            //         }
            //         // 配列 labels 内の label を content-td に追加する
            //         labels.forEach(label=>contentDd.appendChild(label));
            //         document.getElementById(form.id.replace("form","modal")).remove();
            //     }
            //     if(!isValidate){
            //         console.log('validate');
            //     }
            // }
            // /** MODAL を開く前の状態に戻す 再確認 */
            // function cancelColumnModal(param) {
            //     // form の id　から MESSGAE TYPE の SELECT を取得する
            //     const form      =   param.closest("div").querySelector("div.modal-content form");
            //     const select    =   document.getElementById(form.id.replace("form","type"));
            //     // キャンセルボタン に 以前のSELECTの値が value としてある場合 SELECT に以前の値を戻す
            //     if(param.value){
            //         select.value    =   param.value;
            //         select.setAttribute('data-previous-value', param.value);
                    
            //     }else{
            //         select.value    =   "";
            //         select.setAttribute('data-previous-value', "");
            //     }
            //     document.getElementById(form.id.replace("form","modal")).remove();
            // }
        /** MESSAGES TYPE SELECT */
            /** type を選択し、MODAL を開く 調整済み */
            function addMessage(param){
                // select に値がある場合、 MODAL を開く
                if(param.value){
                    openModal(param);
                    // openMessageModal(param);
                }
                // select に値がない場合、初期状態に戻す
                if(!param.value){
                    param.closest("dd").querySelector("button.clearMessage").click();
                }
            }
            /** 入力されている値を編集する MODAL を開く 調整済み */
            function editMessage(param) {
                // content-dd に要素がある場合、 select の値を取得し、それに応じた MODAL を開く
                const contentDd =   param.closest("dl").querySelector("dd.content-dd");
                if(contentDd.querySelectorAll("input").length>0){
                    const select    =   param.closest("dd").querySelector('select.addMessage');
                    const values    =   new Object();
                    // content-dd に収納されているデータの値を values に格納する
                    Array.from(contentDd.querySelectorAll('input, textarea, select')).forEach(node => {
                        values[node.name]   =   node.value;
                    });
                    openModal(select, values);
                }
            }
            /** 選択した列を初期状態に戻す 調整済み */
            function clearMessage(param) {
                // select の値を "" にする
                const select    =   param.closest("dd").querySelector('select.addMessage');
                select.value    =   "";
                // content-dd 内の要素をすべて削除する
                const contentDd =   param.closest("dl").querySelector('dd.content-dd');
                while(contentDd.lastChild){
                    contentDd.removeChild(contentDd.lastChild);
                }
            }

        /** ACTION TYPE SELECT */
            /** type を選択し、MODAL を開く 調整済み */
            function addAction(param){
                // select に値がある場合、 MODAL を開く
                if(param.value){
                    openModal(param);
                    // openActionModal(param);
                }
                // select に値がない場合、初期状態に戻す
                if(!param.value){
                    param.closest("dd").querySelector("button.clearAction").click();
                }
            }
            /** 入力されている値を編集する MODAL を開く 調整済み */
            function editAction(param) {
                // content-dd に要素がある場合、 select の値を取得し、それに応じた MODAL を開く
                const contentDd =   param.closest("dl").querySelector("dd.content-dd");
                if(contentDd.querySelectorAll("input").length>0){
                    const select    =   param.closest("dd").querySelector('select.addAction');
                    const values    =   new Object();
                    // content-dd に収納されているデータの値を values に格納する
                    Array.from(contentDd.querySelectorAll('input, textarea, select')).forEach(node => {
                        values[node.name]   =   node.value;
                    });
                    openActionModal(select, values);
                }
            }
            /** 選択した列を初期状態に戻す 調整済み */
            function clearAction(param) {
                // select の値を "" にする
                const select    =   param.closest("dd").querySelector('select.addAction');
                select.value    =   "";
                // content-dd 内の要素をすべて削除する
                const contentDd =   param.closest("dl").querySelector('dd.content-dd');
                while(contentDd.lastChild){
                    contentDd.removeChild(contentDd.lastChild);
                }
            }


        /** COLUMN */
            /** type を選択し、MODAL を開く 調整済み */
            function addColumn(param){
                if(param.value){
                    openModal(param);
                    // openColumnModal(param);
                }
                // select に値がない場合、初期状態に戻す
                if(!param.value){
                    param.closest("dd").querySelector("button.clearColumn").click();
                }
            }
            /** 入力されている値を編集する MODAL を開く 調整済み */
            function editColumn(param) {
                // content-dd に要素がある場合、 select の値を取得し、それに応じた MODAL を開く
                const contentDd =   param.closest("dl").querySelector("dd.content-dd");
                if(contentDd.querySelectorAll("input").length>0){
                    // content-dd に収納されているデータの値を values に格納する
                    const select    =   param.closest("dd").querySelector("button.addColumn");
                    const values    =   new Object();
                    Array.from(contentDd.querySelectorAll('input, textarea, select')).forEach(node => {
                        values[node.name]   =   node.value;
                    });
                    openModal(select, values);
                }
            }
            /** 選択した列を初期状態に戻す 調整済み */
            function clearColumn(param) {
                // content-dd 内の要素をすべて削除する
                const contentDd =   param.closest("dl").querySelector('dd.content-dd');
                while(contentDd.lastChild){
                    contentDd.removeChild(contentDd.lastChild);
                }
            }

</script>
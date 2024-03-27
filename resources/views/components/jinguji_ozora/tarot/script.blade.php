<script>
    const token         =   document.querySelector("input[name='_token']").value;
    const tarot_deck    =   document.querySelector("form#tarot-deck");
    const result        =   document.querySelector("section#result");
    const result_spread =   document.querySelector("div#tarot-result-spread");
    const result_add    =   document.querySelector("div#tarot-result-add");

    const date          =   new Date();
    const year          =   String(date.getFullYear());
    const month         =   String(date.getMonth()+1).padStart(2,"0");
    const day           =   String(date.getDate()).padStart(2,"0");
    const hours         =   String(date.getHours()).padStart(2,"0");
    const minutes       =   String(date.getMinutes()).padStart(2,"0");
    const seconds       =   String(date.getSeconds()).padStart(2,"0");
</script>

<x-jinguji_ozora.tarot.script.set_tarot_deck />

<x-jinguji_ozora.tarot.script.async_get_tarot_card />
<x-jinguji_ozora.tarot.script.set_tarot_card />

<x-jinguji_ozora.tarot.script.open_tarot_card :gettarotcard="false" :settarotcard="false" />
<x-jinguji_ozora.tarot.script.view_tarot_card />
    
    

    {{-- // function waitForImagesLoading(images){
    //     const promises = [];
    //     images.forEach((image) => {
    //     const promise = new Promise((resolve) => {
    //         if (image.complete) {
    //         resolve();
    //         } else {
    //         image.addEventListener("load", resolve);
    //         }
    //     });
    //     promises.push(promise);
    //     });

    //     return Promise.all(promises);
    // }

    // function saveResultAsImage(){
    //     const for_download  =   document.querySelectorAll(".for-download");
    //     for_download.forEach(node => node.classList.remove("hidden"));
    //     const dom       =   document.getElementById("result");
    //     const images    =   Array.from(dom.querySelectorAll("img"));
    //     waitForImagesLoading(images).then(() => {
    //         html2canvas(dom).then(canvas => {
    //             const a         =   document.createElement("a");
    //             a.href          =   canvas.toDataURL();
    //             a.download      =   "tarot" + year + month + day + hours + minutes + seconds + ".png";
    //             document.body.appendChild(a);
    //             a.click();
    //             document.body.removeChild(a);     
    //         });
    //     });
    //     for_download.forEach(node => node.classList.add("hidden"));
    // }

 --}}

<script>
    function open_tarot_card(name){
        if(name == "spread"){
            set_tarot_deck();
            Array.from(result_spread.children).forEach((dl, index)=>{
                setTimeout(()=>{
                    get_tarot_card(6 + index).then(card => set_tarot_card(dl, card));
                }, 500 * index);
            });
            setTimeout(()=>{
                const add   =   document.querySelector("section#result > div#tarot-cross > div#tarot-result-add");
                add.classList.remove("hidden");
                add.classList.add("fade-in");
            }, 500 * result_spread.children.length);
            setTimeout(() => {
                const button    =   document.getElementById("button-start");
                button.textContent =    "もう一度";
                button.setAttribute("onclick", "location.reload();");
            }, 500 * result_spread.children.length + 2000);
        }
        if(name == "add"){
            const num   =   6 + result_spread.children.length + result_add.children.length - 1;
            if(num < 76){
                const dl_0  =   document.getElementById("tarot-result-0");
                const dl    =   dl_0.cloneNode(true);
                    dl.querySelector("dt.tarot-card-image").innerHTML = null;
                    dl.setAttribute("id", dl.id.replace("0",num));
                get_tarot_card(num).then(card => set_tarot_card(dl, card));
                result_add.insertBefore(dl, dl_0.nextElementSibling);
            }
        }
        if(name == "bottom"){
            const dl    =   document.getElementById("tarot-result-78");
            if(dl.getAttribute("data-tarot-card") == "bottom"){
                get_tarot_card(77).then(card => set_tarot_card(dl, card));
            }
        }
    }
</script>
@if (isset($gettarotcard) && $gettarotcard)
    <x-jinguji_ozora.tarot.script.async_get_tarot_card />
@endif
@if (isset($settarotcard) && $settarotcard)
    <x-jinguji_ozora.tarot.script.set_tarot_card />
@endif
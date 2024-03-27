<script>
    function view_tarot_card(dl){
        const div   =   document.querySelector("div#tarot-card-viewer");
        div.querySelector("dl > dt.tarot-card-image").innerHTML     =   dl.querySelector("dt.tarot-card-image").innerHTML;
        div.querySelector("dl > dd.tarot-card-name").textContent    =   dl.querySelector("dd.tarot-card-name").textContent;
        div.querySelector("dl > dd.tarot-card-number").textContent  =   dl.querySelector("dd.tarot-card-number").textContent;
        div.classList.remove("hidden");
    }
</script>
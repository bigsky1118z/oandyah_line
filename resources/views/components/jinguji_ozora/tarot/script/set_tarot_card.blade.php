<script>
    function set_tarot_card(dl, data){
        dl.setAttribute("data-tarot-card", data.id);
        dl.setAttribute("onclick", "view_tarot_card(this);");
        const tarot_card_image  =   dl.querySelector("dt.tarot-card-image");
        const tarot_card_name   =   dl.querySelector("dd.tarot-card-name");
        const tarot_card_number =   dl.querySelector("dd.tarot-card-number");
        // tarot_card_image    ?   tarot_card_image.innerHTML      =   `<img src="https://oandyah.com/storage/image/tarot/Z_GOLD.png" alt=${data.title_jp}>` : null;
        tarot_card_image    ?   tarot_card_image.innerHTML      =   `<img src="${data.image_url}" alt=${data.title_jp}>` : null;
        tarot_card_name     ?   tarot_card_name.textContent     =   data.name_jp : null;
        tarot_card_number   ?   tarot_card_number.textContent   =   data.number_jp : null;
        dl.classList.add("fade-in");
    }
</script>
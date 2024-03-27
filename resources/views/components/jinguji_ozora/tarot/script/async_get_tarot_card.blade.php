<script>
    async function get_tarot_card(num) {
        const id        =   tarot_deck[num].value;
        const formData  =   new FormData();
            formData.append("id", id);
            formData.append("_token", token);
        const options = {
            method: "post",
            body: formData,
        };
        try {
            const response  =   await fetch("/jinguji_ozora/tarot/get_tarot_card", options);
            const data      =   await response.json();
            return data.card;
        } catch (error) {
            console.log("エラー", error);
            return "エラーが発生しました";
        }
    }
</script>
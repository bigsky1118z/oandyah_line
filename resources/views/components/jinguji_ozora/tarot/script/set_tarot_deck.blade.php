<script>
    function set_tarot_deck(){
        const numbers   =   new Array();
        while(numbers.length < 78){
            const min = 1, max = 78;
            const number    =   Math.floor(Math.random() * (max - min + 1)) + min;
            numbers.includes(number) ? null : numbers.push(number);
        }
        tarot_deck.innerHTML    = null;
        document.getElementById("button-start").removeAttribute("onclick");
        numbers.forEach((number, index)=> tarot_deck.innerHTML  +=  `<input type="hidden" name="tarot_deck[${index}]" value="${number}">`);
    }
</script>
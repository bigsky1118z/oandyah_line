<script>
    function getSingular (number){
        number  =   Number(number);
        const master_11 =   document.getElementById("checkbox-numerology-master-number-11").checked;
        const master_22 =   document.getElementById("checkbox-numerology-master-number-22").checked;
        const master_33 =   document.getElementById("checkbox-numerology-master-number-33").checked;
        while(number>9 && ((master_11 && number!=11) || !master_11) && ((master_22 && number!=22) || !master_22) && ((master_33 && number!=33) || !master_33)){
            const numbers   =   String(number).split("");
            number          =   0;
            numbers.forEach(value=>number+=Number(value));
        }
        return Number(number);
    }
</script>    

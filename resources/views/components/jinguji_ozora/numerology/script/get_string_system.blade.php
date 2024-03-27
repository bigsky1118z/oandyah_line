<script>
    function getStringSystem (string, system) {
        const object  =   new Object();
        if(system == "pythagorean"){
            [
                ["A","J","S"],
                ["B","K","T"],
                ["C","L","U"],
                ["D","M","V"],
                ["E","N","W"],
                ["F","O","X"],
                ["G","P","Y"],
                ["H","Q","Z"],
                ["I","R"],
            ].forEach((array,index) => array.forEach(key => object[key] = index + 1));
        }
        if(system == "chaldean"){
            [
                ["A","I","J","Q","Y"],
                ["B","K","R","S"],
                ["C","G","L","X"],
                ["D","M","T"],
                ["E","H","N"],
                ["U","V","W"],
                ["O","Z"],
                ["F","P"],
            ].forEach((array,index) => array.forEach(key => object[key] = index + 1));
        }
        string  =   String(string).split("").map(value=>Number(object[value])).join("");
        return getSingular(string);
    }
</script>
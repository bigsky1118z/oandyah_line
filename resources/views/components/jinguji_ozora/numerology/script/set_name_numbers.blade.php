<script>
        function setNameNumbers() {
        const lastName  =   document.getElementById("input-last-name")  ?   String(document.getElementById("input-last-name").value).toUpperCase().replace(/[^A-Z]/gi, "")  :   "";
        const firstName =   document.getElementById("input-first-name") ?   String(document.getElementById("input-first-name").value).toUpperCase().replace(/[^A-Z]/gi, "") :   "";
        const name      =   lastName || firstName ? [lastName,firstName].map(value => value ? value.split("").map((value,index)=>index == 0 ? value.toUpperCase() : value.toLowerCase()).join("") : "").join(" ") : "Your Name";

        document.getElementById("output-name") ? document.getElementById("output-name").textContent = name : null;
        const system    =   document.querySelector('input[type="radio"][name="stringSystem"]:checked').value;
        const result    =   {
                "result-name-last-first" :   0,
                "result-name-last"       :   0,
                "result-name-first"      :   0,
                "result-name-vowel"      :   0,
                "result-name-consonant"  :   0,
            }
        if(lastName || firstName){
            document.getElementById("output-lastName")  ?   document.getElementById("output-lastName").textContent  =   lastName.split("").map((value,index)=>index == 0 ? value.toUpperCase() : value.toLowerCase()).join("")    :   null;
            document.getElementById("output-firstName") ?   document.getElementById("output-firstName").textContent =   firstName.split("").map((value,index)=>index == 0 ? value.toUpperCase() : value.toLowerCase()).join("")   :   null;

            const vowel     =   String(lastName+firstName).replace(/[^AEIOU]/gi, "");
            const consonant =   String(lastName+firstName).replace(/[AEIOU]/gi, "");
            Object.keys(result).forEach(key=>{
                switch(key) {
                    case "result-name-last-first" :
                        result[key] =   getStringSystem(lastName+firstName, system);
                        break;
                    case "result-name-last" :
                        result[key] =   getStringSystem(lastName, system);
                        break;
                    case "result-name-first" :
                        result[key] =   getStringSystem(firstName, system);
                        break;
                    case "result-name-vowel" :
                        result[key] =   getStringSystem(vowel, system);
                        break;
                    case "result-name-consonant" :
                        result[key] =   getStringSystem(consonant, system);
                        break;
                }
            });
        }
        Object.keys(result).forEach(key=>document.getElementById(key) ? document.getElementById(key).textContent = result[key] : null);
    }
</script>
@if (isset($getstringsystem) && $getstringsystem)
    <x-jinguji_ozora.numerology.script.get_string_system />
@endif

@if (isset($getsingular) && $getsingular)
    <x-jinguji_ozora.numerology.script.get_singular />
@endif
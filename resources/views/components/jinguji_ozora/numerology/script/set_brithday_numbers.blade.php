<script>
    function setBirthdayNumbers(){
        const year      =   document.getElementById("select-birth-year")    ?   Number(document.getElementById("select-birth-year").value)  :   0;
        const month     =   document.getElementById("select-birth-month")   ?   Number(document.getElementById("select-birth-month").value) :   0;
        const day       =   document.getElementById("select-birth-day")     ?   Number(document.getElementById("select-birth-day").value)   :   0;
        const birthday  =   `${String(year).padStart(4, '0')}年${String(month).padStart(2, "0")}月${String(day).padStart(2, "0")}日`;
        document.getElementById("output-birthday")  ?   document.getElementById("output-birthday").textContent = birthday : null;
        const result    =   {
            "result-birthday-day"               :   0,
            "result-birthday-year-month-day"    :   0,
            "result-birthday-month-day"         :   0,
        }
        Object.keys(result).forEach(key=>{
            if(key=="result-birthday-year-month-day"){
                let number1 =   getSingular(Number(String(year)+"0"+String(month)+"0"+String(day)));
                let number2 =   getSingular(year+month+day);
                let number3 =   getSingular(getSingular(year)+getSingular(month)+getSingular(day));
                result[key] =   Math.max(number1, number2, number3);
            }
            if(key=="result-birthday-month-day"){
                let number1 =   getSingular(Number(String(month)+"0"+String(day)));
                let number2 =   getSingular(month+day);
                let number3 =   getSingular(getSingular(month)+getSingular(day));
                result[key] =   Math.max(number1, number2, number3);
            }
            if(key=="result-birthday-day"){
                result[key] =   getSingular(day);
            }
        });
        Object.keys(result).forEach(key=>document.getElementById(key).textContent = result[key]);
    }
</script>

@if (isset($getsingular) && $getsingular)
    <x-jinguji_ozora.numerology.script.get_singular />
@endif
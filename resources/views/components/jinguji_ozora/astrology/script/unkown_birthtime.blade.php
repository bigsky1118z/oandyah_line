<script>
    function time_of_birth_unknown(){
        const checkbox  =   document.getElementById("checkbox-time-of-birth-unknown");
        const hours     =   document.getElementById("select-time-of-birth-hours");
        const minutes   =   document.getElementById("select-time-of-birth-minutes");
        console.log(checkbox);
        console.log(checkbox.checked);
        
        if(checkbox.checked){
            console.log("check");
            hours.value         =   0;
            hours.disabled      =   true;
            minutes.value       =   0;
            minutes.disabled    =   true;
        }else{
            console.log("uncheck");
            hours.disabled      =   false;
            minutes.disabled    =   false;
        }
    }
</script>
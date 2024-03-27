<script>
    /** SCHEDULE */
        function selectSchedule(param){
            const datetime  =   param.closest("dl").querySelector("input.addReserve");
            if(param.value == "reserve"){
                datetime.disabled   =   false;
                datetime.required   =   true;
            }
            if(param.value != "reserve"){
                datetime.value      =   null;
                datetime.disabled   =   true;
                datetime.required   =   false;
            }
            if(param.value == "draft"){
                param.closest("form").querySelectorAll(".required").forEach(node => {
                    node.required   =   false;
                });
            }
            if(param.value != "draft"){
                param.closest("form").querySelectorAll(".required").forEach(node => {
                    node.required   =   true;
                });
            }
        }

        setInterval(function() {
            const datetime  =   document.querySelector("input[name*='schedule'].addReserve");
            const date      =   new Date();
                date.setMinutes(date.getMinutes() + 30);  // 30分を追加
                const year      =   date.getFullYear();
                const month     =   String(date.getMonth() + 1).padStart(2, '0');
                const day       =   String(date.getDate()).padStart(2, '0');
                const hours     =   String(date.getHours()).padStart(2, '0');
                const minutes   =   String(date.getMinutes()).padStart(2, '0');
            const minTime   =   `${year}-${month}-${day}T${hours}:${minutes}`;
            datetime.setAttribute("min", minTime);
        }, 60000);
</script>
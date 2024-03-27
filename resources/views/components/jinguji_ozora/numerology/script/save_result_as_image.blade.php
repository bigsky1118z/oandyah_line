<script>
        function saveResultAsImage(){
        const for_download  =   document.querySelectorAll(".for-download");
        for_download.forEach(node => node.classList.remove("hidden"));
        const dom   =   document.getElementById({{ isset($id) ? $id : "result" }});
        html2canvas(dom).then(canvas => {
            const a     =   document.createElement("a");
            a.href      =   canvas.toDataURL();
            const name      =   document.getElementById("output-name").textContent != "Your Name" ? document.getElementById("output-name").textContent.replace(" ","") : null;
            const birthday  =   document.getElementById("output-birthday").textContent.replace(/年|月|日/g,"");
            a.download      =   `${name}${birthday}.png`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);     
        });
        for_download.forEach(node => node.classList.add("hidden"));
    }
</script>
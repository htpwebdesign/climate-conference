<!-- <script>
    // JavaScript to handle the accordion functionality
    var accordions = document.querySelectorAll(".event");

    accordions.forEach(function(acc) {
        var accordionBtn = acc.querySelector(".accordion");
        var panel = acc.querySelector(".panel");

        accordionBtn.addEventListener("click", function() {
            this.classList.toggle("active");
            panel.classList.toggle("open");

            if (panel.classList.contains("open")) {
                accordionBtn.innerText = "open";
            } else {
                accordionBtn.innerText = "closed";
            }
        });
    });
</script>

<style>
    .accordion {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        transition: 0.4s;
    }

    .active,
    .accordion:hover {
        background-color: #ccc;
    }

    .panel {
        padding: 0 18px;
        display: none;
        background-color: white;
        overflow: hidden;
    }

    .open {
        display: block;
    }
</style> -->
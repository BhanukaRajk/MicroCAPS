let componentStatus = document.getElementById("component-status");

componentStatus?.addEventListener("change", () => {
    
    let content = document.getElementsByClassName("state");
    for (i = 0; i < content.length; i++) {
        if (!content[i].classList.contains("display-none")) {
            content[i].classList.add("display-none");
        }
    }

    let selectedValue = componentStatus.value;
    if (selectedValue) {
        document.getElementById(selectedValue).classList.remove("display-none");
    }

});
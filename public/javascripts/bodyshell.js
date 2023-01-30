/* Body Shell */
// Body Shell Functions
function rounds(evt, option) {
    var i = 0, shellOption;

    content = document.getElementsByClassName("shell-forms");
    for (i = 0; i < content.length; i++) {
        content[i].classList.remove("display-block");
    }

    shellOption = document.getElementsByClassName("shell-btn");
    for (i = 0; i < shellOption.length; i++) {
        shellOption[i].classList.remove("active");
    }

    document.getElementById(option).classList.add("display-block");
    evt.currentTarget.classList.add("active");
}

// Repir - Paint Checkbox
const repair = document.getElementById("repair");
const paint = document.getElementById("paint");
const repairD = document.getElementById("repairD");
const repairDescription = document.getElementById("repairDescription");

repair?.addEventListener("change", () => {
    if (repair.checked) {
        paint.checked = true;
        repairD.classList.toggle("display-none");
        repairDescription.required = true;
    } else {
        paint.checked = false;
        repairD.classList.toggle("display-none");
        repairDescription.required = false;
    }
});
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
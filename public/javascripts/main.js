const drop = document.getElementById("drop");
const logout = document.getElementById("logout");

drop.addEventListener("click", () => {
    logout.classList.toggle("display-block");
});


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

const dropdown = document.getElementById("dropdown");
const select = document.getElementById("select");
const two = document.getElementById("two");

dropdown.addEventListener("focus", () => {
    select.classList.toggle("display-none");
});

function selectFunc(value) {
    dropdown.value = value;
    select.classList.toggle("display-none");
}

$(document).ready(() => {
    const flash = document.getElementById("flash");
    setTimeout(() => {
        flash.classList.remove("display-block");
    }, 5000);
})

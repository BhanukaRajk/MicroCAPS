// Calender
const calender = document.getElementById("calender");
const ctitle = document.getElementById("calender-title");

document.addEventListener("DOMContentLoaded", () => {
    const today = new Date();
    const year = today.getFullYear();
    const month = today.getMonth() + 1;
    const date = today.getDate();
    const nod = new Date(year, month, 0).getDate();
    let firstDay = new Date(year, month - 1, 1).getDay();

    if (firstDay === 0) {
        firstDay = 7;
    }

    ctitle.innerHTML = today.toLocaleString("en-US", { month: "long" }) + " " + year;
    
    const dates = document.querySelectorAll('.date');

    let start = firstDay - 1;

    for (let i = 1; i < nod + 1; i++) {
        dates[start].innerHTML = i;
        start = (start + 1) % 35;
    }

    dates[(firstDay + date - 2)%35].classList.add("current");
});
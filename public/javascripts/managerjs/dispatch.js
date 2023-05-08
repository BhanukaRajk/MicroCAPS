const chassisNo = document.getElementById("chassisNo");
const showroom = document.getElementById("showroom");

chassisNo?.addEventListener("change", () => {
    chassisNo.classList.add("form-control-blue");
    chassisNo.classList.remove("form-control-red");
    chassisNo.classList.add("text-blue");
    chassisNo.classList.remove("text-red");
});

showroom?.addEventListener("change", () => {
    showroom.classList.remove("form-control-red");
    showroom.classList.add("text-gray");
    showroom.classList.remove("text-red");
});
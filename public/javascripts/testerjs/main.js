const drop = document.getElementById("drop");
const logout = document.getElementById("logout");

drop.addEventListener("click", () => {
    console.log("clicked");
    logout.classList.toggle("show");
});
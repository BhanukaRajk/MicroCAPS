/* Common */
// Logout Dropdown
const drop = document.getElementById("drop");
const logout = document.getElementById("logout");

drop?.addEventListener("click", () => {
    logout.classList.toggle("display-block");
});
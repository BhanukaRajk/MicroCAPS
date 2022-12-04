// const drop = document.getElementById("drop");
const logout = document.getElementById("logout");


/*drop.addEventListener("click", () => {
    logout.classList.toggle("display-block");
});*/

/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function profiledropdown() {
    document.getElementById("profileDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
    if (!event.target.matches('.arrowbtn')) {
        var profiledropdowns = document.getElementsByClassName("profilemenu-content");
        var i;
        for (i = 0; i < profiledropdowns.length; i++) {
            var openDropdown = profiledropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}


function myFunction() {

    var msg = document.getElementById("messagebox");
    // message.className = "show";
    msg.className = msg.className.replace("hideme", "shows showme");
    setTimeout(function(){ msg.className = msg.className.replace("shows showme", "hideme"); }, 3000);
}
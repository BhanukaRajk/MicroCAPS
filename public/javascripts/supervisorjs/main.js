//// const drop = document.getElementById("drop");
//// const logout = document.getElementById("logout");


//// drop.addEventListener("click", () => {
////     logout.classList.toggle("display-block");
//// });
// const URL_ROOT = "http://localhost:8080/MicroCAPS/";


/* WHEN THE USER CLICKS ON THE BUTTON, 
TOGGLE BETWEEN HIDING AND SHOWING THE DROPDOWN CONTENT */
function profiledropdown() {
    document.getElementById("profileDropdown").classList.toggle("show");
}

// CLOSE THE DROPDOWN IF THE USER CLICKS OUTSIDE OF IT
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


function notifyMe() {
    var msg = document.getElementById("messagebox");
    //// message.className = "show";
    msg.className = msg.className.replace("hideme", "shows showme");
    //// setTimeout(function () { if(msg.className == "shows showme") { msg.className = msg.className.replace("shows showme", "hideme"); }}, 10000);
    setTimeout(function () { msg.className = msg.className.replace("shows showme", "hideme"); }, 10000);
}

function closeNotify() {
    var msg = document.getElementById("messagebox");
    msg.className = msg.className.replace("shows showme", "hideme");
}




// NEXT BUTTON
function next(id) {
    location.replace(id);
}


//// function expandConsumable() {
////     document.getElementById("popupbox").classList.toggle("show");
//// }

function closePopup() {
    var popupDiv = document.getElementById('popupWindow');
    popupDiv.style.display = 'none';
}

function showThisPopup(ID) {
    var popupDiv = document.getElementById(ID);
    //// popupDiv.style.display = 'block';
    // popupDiv.classList.remove("hideme");
    // popupDiv.classList.toggle("showme");
    popupDiv.classList.remove("display-none");
}

function closeThisPopup(ID) {
    var popupDiv = document.getElementById(ID);
    //// popupDiv.style.display = 'none';
    // popupDiv.classList.remove("showme");
    // popupDiv.classList.toggle("hideme");
    popupDiv.classList.toggle("display-none");

}




















// window.onclick = function (event) {
//     if (!event.target.matches('#popupWindow')) {
//         var popupwindow = document.getElementsByClassName("delete-conf-blur");
//         console.log(popupwindow.classList);
//         if (!(popupwindow.classList.contains('display-none'))) {
//                 popupwindow.classList.toggle('display-none');
//         }
//     }
// }
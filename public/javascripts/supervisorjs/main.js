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
    setTimeout(function(){ msg.className = msg.className.replace("shows showme", "hideme"); }, 5000);
}

// function expandConsumable() {
//     document.getElementById("popupbox").classList.toggle("show");
// }

// Next Button
function next(id) {
    location.replace(id);
}

function closePopup() {
    var popupDiv = document.getElementById('popupWindow');
    popupDiv.style.display = 'none';
}



function closeConsumeAddingPopup() {
    var popupDiv = document.getElementById('popupWindow3');
    popupDiv.style.display = 'none';
}

function showConsumeAddingPopup() {
    var popupDiv = document.getElementById('popupWindow3');
    popupDiv.style.display = '';
}



function closeAddNewToolPopup() {
    var popupDiv = document.getElementById('tooladdpopupWindow');
    popupDiv.style.display = 'none';   
}

function showAddNewToolPopup() {
    var popupDiv = document.getElementById('tooladdpopupWindow');
    popupDiv.style.display = '';
}

function closeToolDelConfBox() {
    var popupDiv = document.getElementById('toolDelConf');
    popupDiv.style.display = 'none';
}



window.onscroll = function() {topFixer()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function topFixer() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
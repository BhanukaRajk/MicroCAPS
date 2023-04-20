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
    setTimeout(function () { msg.className = msg.className.replace("shows showme", "hideme"); }, 5000);
}




// Next Button
function next(id) {
    location.replace(id);
}


// function expandConsumable() {
//     document.getElementById("popupbox").classList.toggle("show");
// }

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





function closeConsumeDelConfBox() {
    var popupDiv = document.getElementById('consumeDelConf');
    popupDiv.style.display = 'none';
}





function closeAddNewToolPopup() {
    var popupDiv = document.getElementById('tooladdpopupWindow');
    popupDiv.style.display = 'none';
}

function showAddNewToolPopup() {
    var popupDiv = document.getElementById('tooladdpopupWindow');
    popupDiv.style.display = '';
}

function closeToolUpdatePopup() {
    // var popupDiv = document.getElementById('toolUpdatePopUp');
    // popupDiv.style.display = 'none';  
    document.getElementById("toolUpdatePopUp").setAttribute("class", "background-blurer display-none");
}


function showToolDelConfBox() {
    // var popupDiv = document.getElementById('toolUpdatePopUp');
    // popupDiv.style.display = 'none';  
    document.getElementById("toolDelConfirm").setAttribute("class", "delete-conf-blur horizontal-centralizer");
}

function closeToolDelConfBox() {
    // var popupDiv = document.getElementById('toolDelConf');
    // popupDiv.style.display = 'none';
    document.getElementById("toolDelConfirm").setAttribute("class", "delete-conf-blur horizontal-centralizer display-none");

}





// window.onscroll = function() {topFixer()};

// var header = document.getElementById("myHeader");
// var sticky = header.offsetTop;

// function topFixer() {
//   if (window.pageYOffset > sticky) {
//     header.classList.add("sticky");
//   } else {
//     header.classList.remove("sticky");
//   }
// }











function expandTool(tool) {
    // Get the values from the tool card
    var toolName = tool.querySelector('.toolname').innerText;

    var quantity = tool.querySelector('.tool-quantity').innerText;
    //// var quantity = document.querySelector('.tool-quantity').innerText.split(':')[1].trim();

    var toolpic = tool.querySelector('.toolpic');
    var toolImg = toolpic.getAttribute('src');

    // var toolstatus = document.querySelector('.tool-updater').innerText;
    var lastupdate = document.querySelector('.last-update').innerText;



    // Fill the input fields in the form
    document.querySelector('.form-toolname').innerText = toolName;
    document.querySelector('.form-tool-quantity').innerText = quantity;
    document.querySelector('.form-tool-lastupdate').innerText = lastupdate;
    // document.getElementById("quantity").value = quantity;
    //// document.getElementById("formToolImg").value = toolImg;
    //// toolpic.getAttribute('href').value = toolImg;
    document.getElementById("formToolImg").setAttribute("src", toolImg)
    // document.getElementById("toolstatus").value = toolstatus;

    // Show the popup form
    //// document.getElementById("update-form").style.display = "block";
    document.getElementById("toolUpdatePopUp").setAttribute("class", "background-blurer");
}


function expandConsumable(Consume) {
    // Get the values from the tool card
    var toolName = tool.querySelector('.toolname').innerText;

    var quantity = tool.querySelector('.tool-quantity').innerText;
    //// var quantity = document.querySelector('.tool-quantity').innerText.split(':')[1].trim();

    var toolpic = tool.querySelector('.toolpic');
    var toolImg = toolpic.getAttribute('src');

    // var toolstatus = document.querySelector('.tool-updater').innerText;
    var lastupdate = document.querySelector('.last-update').innerText;



    // Fill the input fields in the form
    document.querySelector('.form-toolname').innerText = toolName;
    document.querySelector('.form-tool-quantity').innerText = quantity;
    document.querySelector('.form-tool-lastupdate').innerText = lastupdate;
    // document.getElementById("quantity").value = quantity;
    //// document.getElementById("formToolImg").value = toolImg;
    //// toolpic.getAttribute('href').value = toolImg;
    document.getElementById("formToolImg").setAttribute("src", toolImg)
    // document.getElementById("toolstatus").value = toolstatus;

    // Show the popup form
    //// document.getElementById("update-form").style.display = "block";
    document.getElementById("toolUpdatePopUp").setAttribute("class", "background-blurer");
}
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


function notifyMe() {
    var msg = document.getElementById("messagebox");
    // message.className = "show";
    msg.className = msg.className.replace("hideme", "shows showme");
    // setTimeout(function () { if(msg.className == "shows showme") { msg.className = msg.className.replace("shows showme", "hideme"); }}, 10000);
    setTimeout(function () { msg.className = msg.className.replace("shows showme", "hideme"); }, 10000);
}

function closeNotify() {
    var msg = document.getElementById("messagebox");
    msg.className = msg.className.replace("shows showme", "hideme");
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
    //// var popupDiv = document.getElementById('addNewConBox');
    //// popupDiv.style.display = 'none';
    document.getElementById("addNewConBox").setAttribute("class", "delete-conf-blur horizontal-centralizer display-none");
}

function showConsumeAddingPopup() {
    //// var popupDiv = document.getElementById('addNewConBox');
    //// popupDiv.style.display = '';
    document.getElementById("addNewConBox").setAttribute("class", "delete-conf-blur horizontal-centralizer");
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



function showToolDelConfBox() {
    //// var popupDiv = document.getElementById('toolUpdatePopUp');
    //// popupDiv.style.display = 'none';  
    document.getElementById("toolDelConfirm").setAttribute("class", "delete-conf-blur horizontal-centralizer");
}

function closeToolDelConfBox() {
    //// var popupDiv = document.getElementById('toolDelConf');
    //// popupDiv.style.display = 'none';
    document.getElementById("toolDelConfirm").setAttribute("class", "delete-conf-blur horizontal-centralizer display-none");
}












function expandTool(Tool) {

    // GET THE VALUES FROM THE TOOL CARD
    var toolId = Tool.querySelector('.tool-id').innerText;
    var toolName = Tool.querySelector('.toolname').innerText;
    var status = Tool.querySelector('.tool-status').innerText;
    var quantity = Tool.querySelector('.tool-quantity').innerText;
    var toolpic = Tool.querySelector('.toolpic');
    var toolImg = toolpic.getAttribute('src');
    var lastupdate = Tool.querySelector('.last-update').innerText;

    // FILL THE INPUT FIELDS IN THE FORM
    document.querySelector('.form-toolname').innerText = toolName;

    if(status === "Normal") {
        document.querySelector('#status-opt1').innerText = status;
        document.getElementById("status-opt1").setAttribute("value", status);
        document.querySelector('#status-opt2').innerText = "Need an attention";
        document.getElementById("status-opt2").setAttribute("value", "Need an attention");
    } else {
        document.querySelector('#status-opt1').innerText = status;
        document.getElementById("status-opt1").setAttribute("value", status);
        document.querySelector('#status-opt2').innerText = "Normal";
        document.getElementById("status-opt2").setAttribute("value", "Normal");
    }

    document.querySelector('.form-tool-quantity').innerText = quantity;
    document.querySelector('.form-tool-lastupdate').innerText = lastupdate;
    document.getElementById("formToolImg").setAttribute("src", toolImg);

    document.getElementById("status-form-tool-id").setAttribute("value", toolId);

    // SHOW THE POPUP FORM
    document.getElementById("toolUpdatePopUp").setAttribute("class", "background-bluer");
    // document.getElementsByClassName("toolset-toolview").classList.add("noscroll");
}


function closeToolUpdatePopup() {

    // CLOSE THE POPUP FORM
    document.getElementById("toolUpdatePopUp").setAttribute("class", "background-bluer display-none");
    // document.getElementsByClassName("toolset-toolview").classList.remove("noscroll");
}




function expandConsumable(Consume) {

    // GET THE VALUES FROM THE TOOL CARD
    var consumeId = Consume.querySelector('.con-id').innerText;
    var consumeName = Consume.querySelector('.carmodel').innerText;
    var quantity = Consume.querySelector('.consumable-quantity').innerText;
    var consumepic = Consume.querySelector('.carpic');
    var consumeImg = consumepic.getAttribute('src');
    var lastupdate = Consume.querySelector('.con-last-update').innerText;

    // FILL THE INPUT FIELDS IN THE FORM
    document.querySelector('.form-conname').innerText = consumeName;
    document.querySelector('.form-con-quantity').innerText = "Current Stock: " + quantity;
    document.querySelector('.form-con-lastupdate').innerText = lastupdate;
    document.getElementById("formConsImg").setAttribute("src", consumeImg);
    document.getElementById("formConId").setAttribute("value", consumeId);

    document.getElementById("stock").setAttribute("value", quantity.split(' ')[0].trim());
    document.querySelector('.form-con-stock-label').innerText = "Current Stock update (" + quantity.split(' ')[1].trim() + ")";

    document.getElementById("formConType").setAttribute("value", quantity.split(' ')[1].trim());


    // SHOW THE POPUP FORM
    document.getElementById("consumeUpdatePopUp").setAttribute("class", "background-bluer");
    document.getElementsByClassName("vehicle-data-board").classList.toggle("noscroll");
}


function closeDetailedConsumable() {

    // CLOSE THE POPUP FORM
    document.getElementById("consumeUpdatePopUp").setAttribute("class", "background-bluer display-none");
    document.getElementsByClassName("vehicle-data-board").classList.remove("noscroll");
}


function consumeDeleteConfirmation() {
    // GET THE VALUES FROM THE LEAVE TABLE

    // FILL THE INPUT FIELDS IN THE FORM
    const ConsumableId = document.querySelector('.form-conid').getAttribute('value');
    document.getElementById("del-form-con-id").setAttribute("value", ConsumableId);

    // SHOW THE POPUP FORM
    document.getElementById("popupWindow").classList.remove("display-none");
}


function closeConsumeDeleteConfirmation() {

    // CLOSE THE POPUP FORM
    document.getElementById("popupWindow").classList.toggle("display-none");
    // document.getElementById("popupWindow").setAttribute("class", "delete-conf-blur horizontal-centralizer display-none");
    // document.getElementsByClassName("databoard").classList.remove("noscroll");
}



function leaveDeleteConfirmation(Leave) {
    // GET THE VALUES FROM THE LEAVE TABLE

    // FILL THE INPUT FIELDS IN THE FORM
    document.getElementById("form-leave-id").setAttribute("value", Leave);

    // SHOW THE POPUP FORM
    document.getElementById("popupWindow").classList.remove("display-none");
}


function closeleaveDeleteConfirmation() {

    // CLOSE THE POPUP FORM
    document.getElementById("popupWindow").classList.toggle("display-none");
    // document.getElementById("popupWindow").setAttribute("class", "delete-conf-blur horizontal-centralizer display-none");
    // document.getElementsByClassName("databoard").classList.remove("noscroll");
}




// POPUP FORM CLOSING METHOD TEMPLATE
//// function closeThisPopup() {
////     var popupDiv = document.getElementById('thePopUp');
////     popupDiv.style.display = 'none';
//// }
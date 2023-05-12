function expandThisLeave(ThisLeave) {

    // GET THE VALUES FROM THE TOOL CARD
    var leaveId = ThisLeave.querySelector('.leave-identifier').innerText;
    var empId = ThisLeave.querySelector('.leave-value-emp').innerText;
    var leaveDate = ThisLeave.querySelector('.leave-value-date').innerText;
    var leaveReason = ThisLeave.querySelector('.leave-value-reason').innerText;

    // var consumeImg = consumepic.getAttribute('src');
    // var lastupdate = Consume.querySelector('.con-last-update').innerText;

    console.log(ThisLeave);
    // FILL THE INPUT FIELDS IN THE FORM
    UpdatePopup = document.querySelector('#timeOffUpdatePopUp');
    // document.querySelector('.form-con-quantity').innerText = "Current Stock: " + quantity;
    // document.querySelector('.form-con-lastupdate').innerText = lastupdate;
    // document.getElementById("formConsImg").setAttribute("src", consumeImg);
    console.log(UpdatePopup);

    UpdatePopup.querySelector("#updt-timeoffId").setAttribute("value", leaveId);
    UpdatePopup.querySelector("#updt-employeeId").setAttribute("value", empId);
    UpdatePopup.querySelector("#updt-leavedate").setAttribute("value", leaveDate);
    UpdatePopup.querySelector("#updt-timeoff-reason").innerText = leaveReason;

    UpdatePopup.classList.remove("display-none");


    // document.getElementById("stock").setAttribute("value", quantity.split(' ')[0].trim());
    // document.querySelector('.form-con-stock-label').innerText = "Current Stock update (" + quantity.split(' ')[1].trim() + ")";

    // document.getElementById("formConType").setAttribute("value", quantity.split(' ')[1].trim());


    // SHOW THE POPUP FORM
    // document.getElementById("consumeUpdatePopUp").setAttribute("class", "background-bluer");
    // document.getElementsByClassName("vehicle-data-board").classList.toggle("noscroll");
}



// GET THE VALUES FROM THE LEAVE TABLE
function leaveDeleteConfirmation(Leave) {

    // FILL THE HIDDEN INPUT FIELDS IN THE FORM
    document.getElementById("form-leave-id").setAttribute("value", Leave);

    // SHOW THE POPUP FORM
    document.getElementById("popupWindow").classList.remove("display-none");
}

function closeleaveDeleteConfirmation() {

    // CLOSE THE POPUP FORM
    document.getElementById("popupWindow").classList.toggle("display-none");
    //// document.getElementById("popupWindow").setAttribute("class", "delete-conf-blur horizontal-centralizer display-none");
    //// document.getElementsByClassName("databoard").classList.remove("noscroll");
}





function taskDeleteConfirmation(Car, Process) {
    // GET THE VALUES FROM THE LEAVE TABLE

    // FILL THE INPUT FIELDS IN THE FORM
    document.getElementById("del-task-car-id").setAttribute("value", Car);
    document.getElementById("del-task-process-id").setAttribute("value", Process);

    // SHOW THE POPUP FORM
    document.getElementById("P28_taskdelpopupWindow").classList.remove("display-none");
}


function closeleaveDeleteConfirmation() {

    // CLOSE THE POPUP FORM
    document.getElementById("popupWindow").classList.toggle("display-none");
    //// document.getElementById("popupWindow").setAttribute("class", "delete-conf-blur horizontal-centralizer display-none");
    //// document.getElementsByClassName("databoard").classList.remove("noscroll");
}

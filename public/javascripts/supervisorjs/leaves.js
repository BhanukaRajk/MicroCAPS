function expandThisLeave(ThisLeave) {

    // GET THE VALUES FROM THE TOOL CARD
    var leaveId = ThisLeave.querySelector('.leave-identifier').innerText;
    var empId = ThisLeave.querySelector('.leave-value-emp').innerText;
    var leaveDate = ThisLeave.querySelector('.leave-value-date').innerText;
    var leaveReason = ThisLeave.querySelector('.leave-value-reason').innerText;

    // console.log(ThisLeave);

    // FILL THE INPUT FIELDS IN THE FORM
    UpdatePopup = document.querySelector('#timeOffUpdatePopUp');

    // console.log(UpdatePopup);

    UpdatePopup.querySelector("#updt-timeoffId").setAttribute("value", leaveId);
    UpdatePopup.querySelector("#updt-employeeId").setAttribute("value", empId);
    UpdatePopup.querySelector("#updt-leavedate").setAttribute("value", leaveDate);
    UpdatePopup.querySelector("#updt-timeoff-reason").innerText = leaveReason;

    // SHOW THE POPUP FORM
    UpdatePopup.classList.remove("display-none");

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
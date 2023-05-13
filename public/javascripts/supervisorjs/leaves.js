const BASE_URL = "http://localhost:8080/MicroCAPS/";

function expandThisLeave(ThisLeave) {

    // GET THE VALUES FROM THE TOOL CARD
    var leaveId = ThisLeave.querySelector('.leave-identifier').innerText;
    var empId = ThisLeave.querySelector('.leave-value-emp').innerText;
    var leaveDate = ThisLeave.querySelector('.leave-value-date').innerText;
    var leaveReason = ThisLeave.querySelector('.leave-value-reason').innerText;

    console.log(ThisLeave);

    // FILL THE INPUT FIELDS IN THE FORM
    UpdatePopup = document.querySelector('#timeOffUpdatePopUp');

    console.log(UpdatePopup);

    UpdatePopup.querySelector("#updt-timeoffId").setAttribute("value", leaveId);
    UpdatePopup.querySelector("#updt-employeeId").setAttribute("value", empId);
    UpdatePopup.querySelector("#updt-leavedate").setAttribute("value", leaveDate);
    UpdatePopup.querySelector("#updt-timeoff-reason").innerText = leaveReason;

    UpdatePopup.classList.remove("display-none");


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
}







// const form = document.querySelector('#newLeave');

// form.addEventListener('submit', (event) => {
//     event.preventDefault(); // prevent default form submission behavior

//     const formData = new FormData(form); // get form data

//     fetch(BASE_ROOT + 'Supervisors/addleave', {
//         method: 'POST',
//         body: formData
//     })
//         .then(response => {
//             if (response.ok) {
//                 // handle successful response here
//                 flashMessageDiv.innerText = "Request successful!";
//             } else {
//                 throw new Error('Network response was not ok.');
//             }
//         })
//         .catch(error => {
//             console.error('Error:', error);
//         });
// });


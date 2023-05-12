// GET ALL FILTER CHECKBOXES AND RADIO BUTTONS
const completenesscheckboxes = document.querySelectorAll("input[type=checkbox][class=connected-btn]");
const holdingcheckboxes = document.querySelectorAll("input[type=checkbox][class=holding-btn]");





// let PROCEED = true;
const nextbtn = document.querySelector('#stage-passer');




// DISABLE ALL THE CONNECTION BUTTONS WHEN HOLD BUTTON PRESSED
for (let hdcheckbox of holdingcheckboxes) {

    if (hdcheckbox.checked) {
        const process = hdcheckbox.id;
        const processid = process.split("-")[0];
        const connectbtnx = document.querySelector("input[type=checkbox][name=" + processid + "-con]")
        connectbtnx.disabled = true;
    }

    hdcheckbox?.addEventListener('change', (event) => {

        // CONTROL THE UPDATED PROCESS' HOLD BUTTON AND CONNECT BUTTON
        const holdbtn = event.target;
        const process = holdbtn.id;
        const processid = process.split("-")[0];
        const connectbtn = document.querySelector("input[type=checkbox][name=" + processid + "-con]")

        if (holdbtn.checked) {
            connectbtn.checked = false;
            connectbtn.disabled = true;
        } else {
            connectbtn.disabled = false;
        }

    });
}





let PROCEED = false;
let numUnchecked = completenesscheckboxes.length;

for (let cmcheckbox of completenesscheckboxes) {
    if (cmcheckbox.checked) {
        numUnchecked--;
        if (numUnchecked === 0) {
            PROCEED = true;
        }
    }
}

function updateNextBtnDisabled() {
    nextbtn.disabled = !PROCEED;
}
updateNextBtnDisabled();


for (let cmcheckbox of completenesscheckboxes) {
    cmcheckbox.addEventListener('change', (event) => {
        if (event.target.checked) {
            numUnchecked--;
            if (numUnchecked === 0) {
                PROCEED = true;
            }
        } else if(!event.target.checked) {
            numUnchecked++;
            PROCEED = false;
        }
        updateNextBtnDisabled();
    });
}

updateNextBtnDisabled();







// EVENT LISTNERS TO UPDATE THE PROCESS
for (let cmcheckbox of completenesscheckboxes) {
    cmcheckbox.addEventListener('change', updateProcessStatus);
}
for (let hdcheckbox of holdingcheckboxes) {
    hdcheckbox.addEventListener('change', updateProcessStatus);
}


function updateProcessStatus() {

    const ButtonID = this.id;

    const VehicleId = document.querySelector('#vehicle_id').innerHTML;
    const ProcessId = ButtonID.split("-")[0];

    console.log(VehicleId);
    console.log(ProcessId);

    let completeness, holding;

    if (document.querySelector("input[type=checkbox][name=" + ProcessId + "-con]").checked) {
        completeness = 1;
    } else {
        completeness = 0;
    }

    if (document.querySelector("input[type=checkbox][name=" + ProcessId + "-hold]").checked) {
        holding = 1;
    } else {
        holding = 0;
    }



    // JSON STRINGIFY USED BECAUSE AN ARRAY IS PASSED USING THIS checkboxesset VARIABLE
    const formData = new FormData();
    formData.append("vehicleID", VehicleId);
    formData.append("proID", ProcessId);
    formData.append("completeness", completeness);
    formData.append("holding", holding);


    if (!formData) {
        console.error("FormData not supported");
        return;
    }


    fetch("http://localhost:8080/MicroCAPS/Supervisors/recordUpdateProcess", {
        method: "POST",
        // headers: {
        //     'Content-type': 'multipart/form-data'
        //     'Content-type': 'application/json'
        // },
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {

            console.log("Data = " + data);

        })
        .catch((error) => console.error(error));
}
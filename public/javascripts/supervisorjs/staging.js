// GET ALL FILTER CHECKBOXES AND RADIO BUTTONS
const completenesscheckboxes = document.querySelectorAll("input[type=checkbox][class=connected-btn]");
const holdingcheckboxes = document.querySelectorAll("input[type=checkbox][class=holding-btn]");


// ATTACH EVENT LISTENERS TO ALL FILTER INPUTS
for (let cmcheckbox of completenesscheckboxes) {
    cmcheckbox.addEventListener('change', updateProcess);
}
for (let hdcheckbox of holdingcheckboxes) {
    hdcheckbox.addEventListener('change', updateProcess);
}




function updateProcess() {

    const ButtonID = this.id;

    const ProcessId = ButtonID.split("-")[0];
    console.log(ProcessId);


    const completeness = document.querySelector(
        "input[type=checkbox][name="+ProcessId+"-con]:checked"
    ).map((checkbox) => (checkbox.checked ? "TRUE" : "FALSE"));

    const holding = document.querySelector(
        "input[type=radio][name="+ProcessId+"-hold]:checked"
    ).map((checkbox) => (checkbox.checked ? "TRUE" : "FALSE"));

    
    // JSON STRINGIFY USED BECAUSE AN ARRAY IS PASSED USING THIS checkboxesset VARIABLE
    const formData = new FormData();
    formData.append("completeness", completeness);
    formData.append("holding", holding);


    if (!formData) {
        console.error("FormData not supported");
        return;
    }
    

    fetch("http://localhost:8080/MicroCAPS/Supervisors/findCars", {
        method: "POST",
        // headers: {
        //     'Content-type': 'multipart/form-data'
        //     'Content-type': 'application/json'
        // },
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {

            console.log("Data = "+data);

            const vehicleDataBoard = document.querySelector('#carList');

            if(data) {

                let carSet = '';

                data.forEach((car) => {
                    carSet += `<form method="POST" action="http://localhost:8080/MicroCAPS/Supervisors/getCarInfo"><div onclick="this.closest(\'form\').submit()" class="carcard">
                                <div class="cardhead">
                                    <div class="cardid">
                                        <div class="carmodel">${car.ModelName}</div>
                                        <div class="chassisno">${car.ChassisNo}</div>
                                        <input type="hidden" name="form-car-id" value="${car.ChassisNo}">
                                    </div>
                                </div>
                                <div class="carpicbox">
                                    <img src="http://localhost:8080/MicroCAPS/public/images/cars/${car.ModelName} ${car.Color}.png" class="carpic" alt="Car image" />
                                </div>
                                <div></div>
                            </div></form>`;
                });

                carSet += '';
                vehicleDataBoard.innerHTML = carSet;

            } else {
                vehicleDataBoard.innerHTML =    `<div class="no-data horizontal-centralizer">
                                                    <div class="margin-top-5 vertical-centralizer">
                                                        <div> Nothing to show :( </div>
                                                        <div>
                                                            <img src="http://localhost:8080/MicroCAPS/public/images/common/no_data.png" class="no-data-icon" alt="No Data">
                                                        </div>
                                                    </div>
                                                </div>`;
            }

        })
        .catch((error) => console.error(error));
}
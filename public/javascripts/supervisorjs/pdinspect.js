// GET ALL FILTER CHECKBOXES AND RADIO BUTTONS
const modelcheckboxes = document.querySelectorAll("input[type=checkbox][name=car-model]");
const cmcheckboxes = document.querySelectorAll("input[type=checkbox][name=test-state]");


// ATTACH EVENT LISTENERS TO ALL FILTER INPUTS
for (let modelcheck of modelcheckboxes) {
    modelcheck.addEventListener('change', vehicleFilter);
}
for (let cmcheck of cmcheckboxes) {
    cmcheck.addEventListener('change', vehicleFilter);
}




// FILTERING FUNCTION
function vehicleFilter() {

    const checkboxesset = Array.from(
        document.querySelectorAll("input[type=checkbox][name=car-model]")
        ).map((checkbox) => (checkbox.checked ? checkbox.value : ""));

    const completeness = Array.from(
        document.querySelectorAll("input[type=checkbox][name=test-state]")
        ).map((checkbox) => (checkbox.checked ? checkbox.value : ""));
    

    
    // JSON STRINGIFY USED BECAUSE AN ARRAY IS PASSED USING THIS checkboxesset VARIABLE
    const formData = new FormData();
    formData.append("vehicleTypes", JSON.stringify(checkboxesset));
    formData.append("testModes", JSON.stringify(completeness));


    if (!formData) {
        console.error("FormData not supported");
        return;
    }
    

    fetch(BASE_URL + "Supervisors/findPDICars", {
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
                    carSet += `<form method="POST" action="${BASE_URL}Supervisors/getCarInfo"><div onclick="this.closest(\'form\').submit()" class="carcard">
                                <div class="cardhead">
                                    <div class="cardid">
                                        <div class="carmodel">${car.ModelName}</div>
                                        <div class="chassisno">${car.ChassisNo}</div>
                                        <input type="hidden" name="form-car-id" value="${car.ChassisNo}">
                                    </div>
                                </div>
                                <div class="carpicbox">
                                    <img src="${BASE_URL}public/images/cars/${car.ModelName} ${car.Color}.png" class="carpic" alt="Car image" />
                                </div>
                                <div>
                                    <div class="chassisno">Engine No: ${car.EngineNo}</div>
                                </div>
                            </div></form>`;
                });

                carSet += '';
                vehicleDataBoard.innerHTML = carSet;

            } else {
                vehicleDataBoard.innerHTML =    `<div class="no-data horizontal-centralizer">
                                                    <div class="margin-top-5 vertical-centralizer">
                                                        <div> Nothing to show :( </div>
                                                        <div>
                                                            <img src="${BASE_URL}public/images/common/no_data.png" class="no-data-icon" alt="No Data">
                                                        </div>
                                                    </div>
                                                </div>`;
            }

        })
        .catch((error) => console.error(error));
}
// GET ALL FILTER CHECKBOXES AND RADIO BUTTONS
const checkboxes = document.querySelectorAll("input[type=checkbox][name=car-model]");
const completenessRadios = document.querySelectorAll("input[type=radio][name=completeness]");
const acceptanceRadios = document.querySelectorAll("input[type=radio][name=acceptance]");


// ATTACH EVENT LISTENERS TO ALL FILTER INPUTS
for (let checkbox of checkboxes) {
    checkbox.addEventListener('change', updateFilter);
}
for (let radio of completenessRadios) {
    radio.addEventListener('change', updateFilter);
}
for (let radio of acceptanceRadios) {
    radio.addEventListener('change', updateFilter);
}




function updateFilter() {

    const checkboxesset = Array.from(
        document.querySelectorAll("input[type=checkbox][name=car-model]")
        ).map((checkbox) => (checkbox.checked ? checkbox.value : ""));

    const completeness = document.querySelector(
        "input[type=radio][name=completeness]:checked"
    ).value;
    const acceptance = document.querySelector(
        "input[type=radio][name=acceptance]:checked"
    ).value;

    
    // JSON STRINGIFY USED BECAUSE AN ARRAY IS PASSED USING THIS checkboxesset VARIABLE
    const formData = new FormData();
    formData.append("vehicleTypes", JSON.stringify(checkboxesset));
    formData.append("completeness", completeness);
    formData.append("acceptance", acceptance);


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





// FETCHING FUNCTIONS OF VEHICLE PARTS PAGE

// THE ONLY SELECT TAG HAS ID. IT HAS BEEN CALLED USING ITS ID
const compVehicleSelector = document.querySelector('#vehicle_list');

compVehicleSelector.addEventListener('change', function() {

    // VALUE OF THIS SELECT TAG'S SELECTED DATA
    const selectedValue = this.value;

    const formData = new FormData();
    formData.append("selectedValue", selectedValue);

    if (!formData) {
        console.error("FormData not supported");
        return;
    }
    

    fetch("http://localhost:8080/MicroCAPS/Supervisors/componentsView", {
        method: "POST",
        // headers: {
        //     'Content-type': 'multipart/form-data'
        //     'Content-type': 'application/json'
        // },
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {

            // PAGE'S CHANGING POINTS CATCHER
            const partDataBoard = document.querySelector('#partsTable');
            const partPageID = document.querySelector('#partPageId');

            // PARTS TABLE HEADING WRITER
            let partSet = `<div class="parts-table-row">
                                <div class="parts-col-01 parts-bold">PART NAME</div>
                                <div class="parts-col-02 parts-bold">STATUS</div>
                                <div class="parts-col-03 parts-bold">DAMAGES</div>
                                <div class="parts-col-04 parts-bold">ISSUED</div>
                            </div>
                            <div class="bottom-border"></div>`;


            // CHECKING IF THERE ARE PARTS AVAILABLE FOR SELECTED VEHICLE
            if(data.componentz) {

                // DISPLAY ALL THE PARTS AVAILABLE
                (data.componentz).forEach((component) => {
                    partSet += `<div class="parts-table-row bottom-border">
                                            <div class="parts-col-01">${component.PartName}</div>
                                            <div class="parts-col-02">${component.Status}</div>
                                            <div class="parts-col-03">
                                                <div class="round">
                                                    <input type="checkbox" id="${component.PartNo}D" ${component.Status == "DAMAGED" ? "checked" : "" } />
                                                    <label for="${component.PartNo}D"></label>
                                                </div>
                                            </div>
                                            <div class="parts-col-04">
                                                <div class="round">
                                                    <input type="checkbox" id="${component.PartNo}I" ${component.Status == "ISSUED" ? "checked" : "" } />
                                                    <label for="${component.PartNo}I"></label>
                                                </div>
                                            </div>
                                        </div>`;
                });

            // IF THERE ARE NO ANY PARTS, DISPLAY THE NOTHING MESSAGE
            } else {
                partSet += `<div class="horizontal-centralizer">
                                                <div class="marginy-4">No parts available</div>
                                                <div class=""></div>
                                            </div>
                                            <div class="bottom-border"></div>`;
            }

            // PARTS TABLE DATA CHANGER
            partDataBoard.innerHTML = partSet;


            // PAGE HEADING CHASSIS NUMBER CHANGER
            if(data.search) {
                partPageID.innerHTML = `Part details - ${data.search}`;
            }

        })
        .catch((error) => console.error(error));
});
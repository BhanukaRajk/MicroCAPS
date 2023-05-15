
// GETTING BUTTON S FROM THE CAR COMPONENTS VEHICLE LIST PAGE
const modelfilters = document.querySelectorAll("input[type=checkbox][name=car-model]");
const stagefilters = document.querySelectorAll("input[type=checkbox][name=car-stage]");
const progressfilters = document.querySelectorAll("input[type=radio][name=progress]");


// ATTACH EVENT LISTENERS TO ALL FILTER INPUTS
for (let model of modelfilters) {
    model.addEventListener('change', filterCars);
}
for (let stage of stagefilters) {
    stage.addEventListener('change', filterCars);
}
for (let progress of progressfilters) {
    progress.addEventListener('change', filterCars);
}



// FILTER CARS ON COMPONENTS' VEHICLE LIST PAGE
function filterCars() {

    const modelset = Array.from(
        document.querySelectorAll("input[type=checkbox][name=car-model]")
        ).map((checkbox) => (checkbox.checked ? checkbox.value : ""));

    const stageset = Array.from(
        document.querySelectorAll("input[type=checkbox][name=car-stage]")
        ).map((checkbox) => (checkbox.checked ? checkbox.value : ""));

    const current_progress = document.querySelector(
        "input[type=radio][name=progress]:checked"
    ).value;



    console.log(JSON.stringify(modelset));
    console.log(JSON.stringify(stageset));
    console.log(current_progress);


    const formData = new FormData();
    formData.append("model_set", JSON.stringify(modelset));
    formData.append("stage_set", JSON.stringify(stageset));
    formData.append("current_progress", current_progress);

    if (!formData) {
        console.error("FormData not supported");
        return;
    }
    
    // COMPONENTS PAGE NEED THE CARS FROM ASSEMBLY LINE, THAT'S WHY ASSEMBLY LINE CHOSEN
    fetch(BASE_URL + "Supervisors/findAssemblyLineCars", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {

            console.log("Data = "+data);

            const vehicleDataBoard = document.querySelector('#carList');

            if(data) {

                let carSet = '';

                data.forEach((car) => {
                    carSet += `<form method="POST" action="${BASE_URL}Supervisors/componentsView">
                                <div class="carcard" onClick="this.closest(\'form\').submit()">
                                    <div class="cardhead">
                                        <div class="cardid">
                                            <div class="carmodel">${car.ModelName}</div>
                                            <div class="chassisno">${car.ChassisNo}</div>
                                            <input type="hidden" name="form-car-id" value="${car.ChassisNo}">
                                        </div>
                                        <div class="carstatuscolor">
                                            <div class="status-circle ${car.CurrentStatus == "H" ? 'status-orange-circle' : 'status-green-circle' }"></div>
                                        </div>
                                    </div>
                                    <div class="carpicbox">
                                        <img src="${BASE_URL}public/images/cars/${car.ModelName + " " + car.Color}.png" class="carpic" alt="Car image">
                                    </div>
                                    <div class="carstatus">`;

                    if(car.CurrentStatus == "S1") { carSet += `Stage 01`; }
                    else if(car.CurrentStatus == "S2") { carSet += `Stage 02`; }
                    else if(car.CurrentStatus == "S3") { carSet += `Stage 03`; }
                    else if(car.CurrentStatus == "S4") { carSet += `Stage 04`; }
                    else { carSet += `On-Hold`; }

                    carSet += `<input type="hidden" name="form-car-stage" value="${car.CurrentStatus}">
                            </div>
                        </div>
                    </form>`;
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










// SELECT TAG ON VEHICLE COMPONENT DETAILS PAGE
const compVehicleSelector = document.querySelector('#P23_vehicle_list');

compVehicleSelector?.addEventListener('change', function() {

    // VALUE OF THIS SELECT TAG'S SELECTED DATA
    const selectedValue = this.value;

    const formData = new FormData();
    formData.append("selectedValue", selectedValue);

    if (!formData) {
        console.error("FormData not supported");
        return;
    }
    

    fetch(BASE_URL + "Supervisors/componentsView", {
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

                    Status = '';

                    if (component.Status == "D") Status = 'PRE-DAMAGED';
                    else if(component.Status == "ID") Status = 'DAMAGED';
                    else if(component.Status == "I") Status = 'ISSUED';
                    else if(component.Status == "NR") Status = 'REQUESTED';
                    else if(component.Status == "R") Status = 'RECEIVED';
                    else Status = 'NOT ISSUED';

                    partSet += `<div class="parts-table-row bottom-border">
                                            <div class="parts-col-01">${component.PartName}</div>
                                            <div class="parts-col-02">${Status}</div>
                                            <div class="parts-col-03">
                                                <div class="round">
                                                    <input type="checkbox" id="${component.PartNo}-D"  onclick="updateComponentStatus(${component.PartNo.trm()} ','${component.Status == "NR" || component.Status == "R"  || component.Status == "D" ? 'D' : 'ID' }')"  ${Status == "DAMAGED" ? "checked" : "" } ${component.Status == "NR" || component.Status == "D" || component.Status == "ID" ? "disabled" : "" }/>
                                                    <label for="${component.PartNo}D"></label>
                                                </div>
                                            </div>
                                            <div class="parts-col-04">
                                                <div class="round">
                                                    <input type="checkbox" id="${component.PartNo}-I" onclick="updateComponentStatus(${component.PartNo.trm()} ','I')" ${Status == "ISSUED" ? "checked" : "" } ${component.Status == "NR" || component.Status == "I" || component.Status == "D" || component.Status == "ID" ? "disabled" : "" }/>
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















// GET ALL FILTER CHECKBOXES AND RADIO BUTTONS
// const issuedcheckboxes = document.querySelectorAll("input[type=checkbox][class=issue-check]");
// const damagedcheckboxes = document.querySelectorAll("input[type=checkbox][class=damage-check]");


// // EVENT LISTNERS TO UPDATE THE PROCESS
// for (let issuedcheckbox of issuedcheckboxes) {
//     issuedcheckbox.addEventListener('change', updatePartStatus);
// }
// for (let dmgcheckbox of damagedcheckboxes) {
//     dmgcheckbox.addEventListener('change', updatePartStatus);
// }


// function updatePartStatus() {

//     const ButtonID = this.id;

//     const VehicleId = document.querySelector('#vehicle_no').innerHTML;
//     const PartId = ButtonID.split("-")[0];

//     console.log(VehicleId);
//     console.log(PartId);

//     let ISSUED, DAMAGED;

//     if (document.querySelector("input[type=checkbox][id=" + PartId + "-I]").checked) {
//         ISSUED = 1;
//     } else {
//         ISSUED = 0;
//     }

//     if (document.querySelector("input[type=checkbox][id=" + PartId + "-D]").checked) {
//         DAMAGED = 1;
//     } else {
//         DAMAGED = 0;
//     }



//     const formData = new FormData();
//     formData.append("vehicle", VehicleId);
//     formData.append("part", PartId);
//     formData.append("issued", ISSUED);
//     formData.append("damaged", DAMAGED);


//     if (!formData) {
//         console.error("FormData not supported");
//         return;
//     }


//     fetch(BASE_URL + "Supervisors/recordComponentDefects", {
//         method: "POST",
//         // headers: {
//         //     'Content-type': 'multipart/form-data'
//         //     'Content-type': 'application/json'
//         // },
//         body: formData,
//     })
//         .then((response) => response.json())
//         .then((data) => {

//             console.log("Data = " + data);

//         })
//         .catch((error) => console.error(error));
// }

function updateComponentStatus(PartNo, Status) {

    const VehicleId = document.querySelector('#vehicle_no').innerHTML;

    const checkbox = document.querySelector("input[type=checkbox][name=" + PartNo + "-" + Status +"]");

    // console.log(checkbox);

    // JSON STRINGIFY USED BECAUSE AN ARRAY IS PASSED USING THIS checkboxesset VARIABLE
    const formData = new FormData();
    formData.append("vehicle", VehicleId);
    formData.append("part", PartNo);
    formData.append("status", Status);

    if (!formData) {
        console.error("FormData not supported");
        return;
    }


    fetch(BASE_URL + "Supervisors/recordUpdateComponent", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {

            location.reload();

        })
        .catch((error) => console.error(error));
}
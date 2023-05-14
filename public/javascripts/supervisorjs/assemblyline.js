// GET ALL FILTER CHECKBOXES AND RADIO BUTTONS
const modelfilters = document.querySelectorAll("input[type=checkbox][name=car-model]");
const stagefilters = document.querySelectorAll("input[type=checkbox][name=car-stage]");
const progressfilters = document.querySelectorAll("input[type=radio][name=progress]");


// Attach event listeners to all filter inputs
for (let model of modelfilters) {
    model.addEventListener('change', filter_cars);
}
for (let stage of stagefilters) {
    stage.addEventListener('change', filter_cars);
}
for (let progress of progressfilters) {
    progress.addEventListener('change', filter_cars);
}




function filter_cars() {

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
                    carSet += `<form method="POST" action="${BASE_URL}Supervisors/getProcess">
                                <div class="carcard" onClick="this.closest(\'form\').submit()">
                                    <div class="cardhead">
                                        <div class="cardid">
                                            <div class="carmodel">${car.ModelName}</div>
                                            <div class="chassisno">${car.ChassisNo}</div>
                                            <input type="hidden" name="form-car-id" value="${car.ChassisNo}">
                                        </div>
                                    </div>
                                    <div class="carpicbox">
                                        <img src="${BASE_URL}public/images/cars/${car.ModelName + " " + car.Color}.png" class="carpic" alt="Car image">
                                    </div>
                                    <div class="carmodel `;

                    if(car.CurrentStatus == "S1") { carSet += `text-green">Stage 01`; }
                    else if(car.CurrentStatus == "S2") { carSet += `text-green">Stage 02`; }
                    else if(car.CurrentStatus == "S3") { carSet += `text-green">Stage 03`; }
                    else if(car.CurrentStatus == "S4") { carSet += `text-green">Stage 04`; }
                    else { carSet += `text-orange">On-Hold`; }

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


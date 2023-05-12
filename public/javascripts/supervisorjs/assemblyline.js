// GET ALL FILTER CHECKBOXES AND RADIO BUTTONS
const modelfilters = document.querySelectorAll("input[type=checkbox][name=car-model]");
const stagefilters = document.querySelectorAll("input[type=checkbox][name=car-stage]");
const timelinefilters = document.querySelectorAll("input[type=radio][name=timeline]");


// Attach event listeners to all filter inputs
for (let model of modelfilters) {
    model.addEventListener('change', filter_cars);
}
for (let stage of stagefilters) {
    stage.addEventListener('change', filter_cars);
}
for (let timeline of timelinefilters) {
    timeline.addEventListener('change', filter_cars);
}




function filter_cars() {

    const modelset = Array.from(
        document.querySelectorAll("input[type=checkbox][name=car-model]")
        ).map((checkbox) => (checkbox.checked ? checkbox.value : ""));

    const stageset = Array.from(
        document.querySelectorAll("input[type=checkbox][name=car-stage]")
        ).map((checkbox) => (checkbox.checked ? checkbox.value : ""));

    const timescale = document.querySelector(
        "input[type=radio][name=timeline]:checked"
    ).value;



    console.log(JSON.stringify(modelset));
    console.log(JSON.stringify(stageset));
    console.log(timescale);

    const formData = new FormData();
    formData.append("model_set", JSON.stringify(modelset));
    formData.append("stage_set", JSON.stringify(stageset));
    formData.append("time_scale", timescale);


    if (!formData) {
        console.error("FormData not supported");
        return;
    }
    

    fetch("http://localhost:8080/MicroCAPS/Supervisors/findAssemblyLineCars", {
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
                    carSet += `<form method="POST" action="http://localhost:8080/MicroCAPS/Supervisors/getProcess">
                                <div class="carcard" onClick="this.closest(\'form\').submit()">
                                    <div class="cardhead">
                                        <div class="cardid">
                                            <div class="carmodel">${car.ModelName}</div>
                                            <div class="chassisno">${car.ChassisNo}</div>
                                            <input type="hidden" name="form-car-id" value="${car.ChassisNo}">
                                        </div>
                                    </div>
                                    <div class="carpicbox">
                                        <img src="http://localhost:8080/MicroCAPS/public/images/cars/${car.ModelName + " " + car.Color}.png" class="carpic" alt="Car image">
                                    </div>
                                    <div class="carstatus">`;

                    if(car.CurrentStatus == "S1") { carSet += `At Stage 01`; }
                    else if(car.CurrentStatus == "S2") { carSet += `At Stage 02`; }
                    else if(car.CurrentStatus == "S3") { carSet += `At Stage 03`; }
                    else if(car.CurrentStatus == "S4") { carSet += `At Stage 04`; }
                    else { carSet += `Out of assembly`; }

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
                                                            <img src="http://localhost/MicroCAPS/public/images/common/no_data.png" class="no-data-icon" alt="No Data">
                                                        </div>
                                                    </div>
                                                </div>`;
            }

        })
        .catch((error) => console.error(error));
}


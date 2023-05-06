const ctypeRadios = document.querySelectorAll("input[type=radio][name=cons-type]");
const cstateRadios = document.querySelectorAll("input[type=radio][name=stock-state]");


// Attach event listeners to all filter inputs

for (let radio of ctypeRadios) {
    radio.addEventListener('change', consumeFilter);
}
for (let radio of cstateRadios) {
    radio.addEventListener('change', consumeFilter);
}




function consumeFilter() {

    const typeOfConsume = document.querySelector(
        "input[type=radio][name=cons-type]:checked"
    ).value;
    const stateOfConsume = document.querySelector(
        "input[type=radio][name=stock-state]:checked"
    ).value;



    console.log(typeOfConsume);
    console.log(stateOfConsume);

    const formData = new FormData();
    formData.append("typeOfConsume", typeOfConsume);
    formData.append("stateOfConsume", stateOfConsume);


    if (!formData) {
        console.error("FormData not supported");
        return;
    }
    

    fetch("http://localhost:8080/MicroCAPS/Supervisors/findConsumables", {
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

            const vehicleDataBoard = document.querySelector('#consumeBoard');

            if(data) {

                let consumeSet = '';

                data.forEach((consume) => {
                    consumeSet += `<div class="carcard" onclick="expandConsumable(this)">
                                    <div class="cardhead">
                                        <div class="cardid">
                                        <div class="con-id display-none">${consume.ConsumableId}</div>
                                        <div class="carmodel">${consume.ConsumableName}</div>
                                        <div class="chassisno">${consume.Volume == null ? 'Grease' : 'Lubricants'}</div>
                                        <div class="consumable-quantity display-none">${consume.Volume == null ? consume.Weight+' Kgs' : consume.Volume+' Liters'}</div>
                                        </div>
                                        <div class="carstatuscolor">
                                        <div class="status-circle ${consume.Volume == null ? (consume.Weight >= 60 ? 'status-green-circle' : 'status-orange-circle') : (consume.Volume >= 60 ? 'status-green-circle' : 'status-orange-circle')} "></div>
                                        </div>
                                    </div>
                                    <div class="carpicbox">
                                        <img src="http://localhost:8080/MicroCAPS/public/images/consumables/${consume.Image}" class="carpic" alt="${consume.ConsumableName}">
                                    </div>
                                    <div class="carstatus ${consume.Volume == null ? (consume.Weight >= 60 ? 'available' : 'lower') : (consume.Volume >= 60 ? 'available' : 'lower')}">${consume.Volume == null ? (consume.Weight >= 60 ? 'Available' : 'Low in stock') : (consume.Volume >= 60 ? 'Available' : 'Low in stock')}</div>
                                    <div class="chassisno con-last-update">Last update: ${consume.UDate} at ${consume.UTime.substring(0, 5)} </div>
                                    </div>`;
                });

                consumeSet += '';
                vehicleDataBoard.innerHTML = consumeSet;

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





const tooltypeRadios = document.querySelectorAll("input[type=radio][name=cons-type]");
const toolstateRadios = document.querySelectorAll("input[type=radio][name=stock-state]");


// Attach event listeners to all filter inputs

for (let radio of ctypeRadios) {
    radio.addEventListener('change', consumeFilter);
}
for (let radio of cstateRadios) {
    radio.addEventListener('change', consumeFilter);
}




function consumeFilter() {

    const typeOfConsume = document.querySelector(
        "input[type=radio][name=cons-type]:checked"
    ).value;
    const stateOfConsume = document.querySelector(
        "input[type=radio][name=stock-state]:checked"
    ).value;



    console.log(typeOfConsume);
    console.log(stateOfConsume);

    const formData = new FormData();
    formData.append("typeOfConsume", typeOfConsume);
    formData.append("stateOfConsume", stateOfConsume);


    if (!formData) {
        console.error("FormData not supported");
        return;
    }
    

    fetch("http://localhost:8080/MicroCAPS/Supervisors/findConsumables", {
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

            const vehicleDataBoard = document.querySelector('#consumeBoard');

            if(data) {

                let consumeSet = '';

                data.forEach((consume) => {
                    consumeSet += `<div class="carcard" onclick="expandConsumable(this)">
                                    <div class="cardhead">
                                        <div class="cardid">
                                        <div class="con-id display-none">${consume.ConsumableId}</div>
                                        <div class="carmodel">${consume.ConsumableName}</div>
                                        <div class="chassisno">${consume.Volume == null ? 'Grease' : 'Lubricants'}</div>
                                        <div class="consumable-quantity display-none">${consume.Volume == null ? consume.Weight+' Kgs' : consume.Volume+' Liters'}</div>
                                        </div>
                                        <div class="carstatuscolor">
                                        <div class="status-circle ${consume.Volume == null ? (consume.Weight >= 60 ? 'status-green-circle' : 'status-orange-circle') : (consume.Volume >= 60 ? 'status-green-circle' : 'status-orange-circle')} "></div>
                                        </div>
                                    </div>
                                    <div class="carpicbox">
                                        <img src="http://localhost:8080/MicroCAPS/public/images/consumables/${consume.Image}" class="carpic" alt="${consume.ConsumableName}">
                                    </div>
                                    <div class="carstatus ${consume.Volume == null ? (consume.Weight >= 60 ? 'available' : 'lower') : (consume.Volume >= 60 ? 'available' : 'lower')}">${consume.Volume == null ? (consume.Weight >= 60 ? 'Available' : 'Low in stock') : (consume.Volume >= 60 ? 'Available' : 'Low in stock')}</div>
                                    <div class="chassisno con-last-update">Last update: ${consume.UDate} at ${consume.UTime.substring(0, 5)} </div>
                                    </div>`;
                });

                consumeSet += '';
                vehicleDataBoard.innerHTML = consumeSet;

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


<<<<<<< HEAD
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
    

    fetch("http://localhost/MicroCAPS/Supervisors/findConsumables", {
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

            const consumeDataBoard = document.querySelector('#consumeBoard');

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
                                        <img src="http://localhost/MicroCAPS/public/images/consumables/${consume.Image}" class="carpic" alt="${consume.ConsumableName}">
                                    </div>
                                    <div class="carstatus ${consume.Volume == null ? (consume.Weight >= 60 ? 'available' : 'lower') : (consume.Volume >= 60 ? 'available' : 'lower')}">${consume.Volume == null ? (consume.Weight >= 60 ? 'Available' : 'Low in stock') : (consume.Volume >= 60 ? 'Available' : 'Low in stock')}</div>
                                    <div class="chassisno con-last-update">Last update: ${consume.UDate} at ${consume.UTime.substring(0, 5)} </div>
                                    </div>`;
                });

                consumeSet += '';
                consumeDataBoard.innerHTML = consumeSet;

            } else {
                consumeDataBoard.innerHTML =    `<div class="no-data horizontal-centralizer">
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








const tooltypeRadios = document.querySelectorAll("input[type=radio][name=tool-type]");
const toolstateRadios = document.querySelectorAll("input[type=radio][name=tool-state]");


// Attach event listeners to all filter inputs
for (let radio of tooltypeRadios) {
    radio.addEventListener('change', toolFilter);
}
for (let radio of toolstateRadios) {
    radio.addEventListener('change', toolFilter);
}




function toolFilter() {

    const typeOfTool = document.querySelector(
        "input[type=radio][name=tool-type]:checked"
    ).value;
    const stateOfTool = document.querySelector(
        "input[type=radio][name=tool-state]:checked"
    ).value;



    console.log(typeOfTool);
    console.log(stateOfTool);

    const formData = new FormData();
    formData.append("typeOfTool", typeOfTool);
    formData.append("stateOfTool", stateOfTool);


    if (!formData) {
        console.error("FormData not supported");
        return;
    }
    

    fetch("http://localhost/MicroCAPS/Supervisors/findToolz", {
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

            const toolDataBoard = document.querySelector('#toolBoard');

            if(data) {

                let toolSet = '';

                data.forEach((tool) => {
                    toolSet += `<div class="toolcard" onclick="expandTool(this)">
                                    <div class="cardhead">
                                    <div class="cardid">
                                        <div class="tool-id display-none">${tool.ConsumableId}</div>
                                        <div class="toolname">${tool.ToolName}</div>
                                        <div class="tool-quantity">Quantity: ${tool.quantity}</div>
                                    </div>
                                    <div class="toolstatuscolor">
                                        <div class="tool-status display-none">${tool.Status}</div>
                                        <div class="status-circle ${tool.Status == "Normal" ? 'status-green-circle' : 'status-orange-circle'} "></div>
                                    </div>
                                    </div>
                                    <div class="toolpicbox">
                                    <img src="http://localhost/MicroCAPS/public/images/tools/${tool.Image != null ? tool.Image : 'none.jpeg'}" class="toolpic" alt="${tool.ToolName}">
                                    </div>
                                    <div class="tool-card-down">
                                    <div class="tool-updater ${tool.Status == "Normal" ? 'available' : 'lower'}">${tool.Status == "Normal" ? 'Normal' : 'Need an attention'}</div>
                                    <div class="toolupdate last-update">Last update: ${tool.UDate} at ${tool.UTime.substring(0, 5)}</div>
                                    </div>
                                </div>`;

                });

                toolSet += '';
                toolDataBoard.innerHTML = toolSet;

            } else {
                toolDataBoard.innerHTML =    `<div class="no-data horizontal-centralizer">
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

=======
>>>>>>> bhanuka

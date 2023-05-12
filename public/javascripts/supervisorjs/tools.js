// TOOLS FILTERING FUNCTION
const tooltypeRadios = document.querySelectorAll("input[type=radio][name=tool-type]");
const toolstateRadios = document.querySelectorAll("input[type=radio][name=tool-state]");


// ATTACH EVENT LISTENERS TO ALL FILTER INPUTS

// CHECK ALL RADIO BUTTONS AND CALL FILTERING FUNCTION WHEN ANY OF THEM IS CHANGED
for (let radio of tooltypeRadios) {
    radio.addEventListener('change', toolFilter);
}
for (let radio of toolstateRadios) {
    radio.addEventListener('change', toolFilter);
}



// TOOL FILTERING FUNCTION
function toolFilter() {

    // WHEN A SINGLE FILTERING CATEGORY IS CHANGED, IT HAS TO CHECK ALL THE REQUIREMENTS
    const typeOfTool = document.querySelector(
        "input[type=radio][name=tool-type]:checked"
    ).value;

    const stateOfTool = document.querySelector(
        "input[type=radio][name=tool-state]:checked"
    ).value;


    // +++++++ FOR TESTING +++++++
    console.log(typeOfTool);
    console.log(stateOfTool);
    // +++++++++++++++++++++++++++


    // SETTING KEY VALUES
    const formData = new FormData();
    formData.append("typeOfTool", typeOfTool);
    formData.append("stateOfTool", stateOfTool);


    if (!formData) {
        console.error("FormData not supported");
        return;
    }
    

    fetch("http://localhost:8080/MicroCAPS/Supervisors/findToolz", {
        method: "POST",
        // headers: {
        //     // 'Content-type': 'multipart/form-data'
        //     'Content-type': 'application/json'
        // },
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {

            // ++++++ ONLY FOR TESTING PROCESS +++++++
            console.log("Data = "+data);
            // +++++++++++++++++++++++++++++++++++++++

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
                                    <img src="http://localhost:8080/MicroCAPS/public/images/tools/${tool.Image != null ? tool.Image : 'none.jpeg'}" class="toolpic" alt="${tool.ToolName}">
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
                                                            <img src="http://localhost:8080/MicroCAPS/public/images/common/no_data.png" class="no-data-icon" alt="No Data">
                                                        </div>
                                                    </div>
                                                </div>`;
            }

        })
        .catch((error) => console.error(error));
}





function expandTool(Tool) {

    // GET THE VALUES FROM THE TOOL CARD
    var toolId = Tool.querySelector('.tool-id').innerText;
    var toolName = Tool.querySelector('.toolname').innerText;
    var status = Tool.querySelector('.tool-status').innerText;
    var quantity = Tool.querySelector('.tool-quantity').innerText;
    var toolpic = Tool.querySelector('.toolpic');
    var toolImg = toolpic.getAttribute('src');
    var lastupdate = Tool.querySelector('.last-update').innerText;

    // FILL THE INPUT FIELDS IN THE FORM
    document.querySelector('.form-toolname').innerText = toolName;

    if(status === "Normal") {
        document.querySelector('#status-opt1').innerText = status;
        document.getElementById("status-opt1").setAttribute("value", status);
        document.querySelector('#status-opt2').innerText = "Need an attention";
        document.getElementById("status-opt2").setAttribute("value", "Need an attention");
    } else {
        document.querySelector('#status-opt1').innerText = status;
        document.getElementById("status-opt1").setAttribute("value", status);
        document.querySelector('#status-opt2').innerText = "Normal";
        document.getElementById("status-opt2").setAttribute("value", "Normal");
    }

    document.querySelector('.form-tool-quantity').innerText = quantity;
    document.querySelector('.form-tool-lastupdate').innerText = lastupdate;
    document.getElementById("formToolImg").setAttribute("src", toolImg);

    document.getElementById("status-form-tool-id").setAttribute("value", toolId);

    // SHOW THE POPUP FORM
    document.getElementById("toolUpdatePopUp").setAttribute("class", "background-bluer");
    //// document.getElementsByClassName("toolset-toolview").classList.add("noscroll");
}


function closeAddNewToolPopup() {
    var popupDiv = document.getElementById('tooladdpopupWindow');
    popupDiv.style.display = 'none';
}

function showAddNewToolPopup() {
    var popupDiv = document.getElementById('tooladdpopupWindow');
    popupDiv.style.display = '';
}



function showToolDelConfBox() {
    //// var popupDiv = document.getElementById('toolUpdatePopUp');
    //// popupDiv.style.display = 'none';  
    document.getElementById("toolDelConfirm").setAttribute("class", "delete-conf-blur horizontal-centralizer");
}

function closeToolDelConfBox() {
    //// var popupDiv = document.getElementById('toolDelConf');
    //// popupDiv.style.display = 'none';
    document.getElementById("toolDelConfirm").setAttribute("class", "delete-conf-blur horizontal-centralizer display-none");
}


function closeToolUpdatePopup() {

    // CLOSE THE POPUP FORM
    document.getElementById("toolUpdatePopUp").setAttribute("class", "background-bluer display-none");
    //// document.getElementsByClassName("toolset-toolview").classList.remove("noscroll");
}
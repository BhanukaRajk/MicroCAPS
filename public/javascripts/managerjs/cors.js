// Flash Message
$(document).ready(() => {

    if (getItem("FlashState") === "Successful") {
        alertSuccess(getItem("FlashMessage"));
    } else if (getItem("FlashState") === "Error") {
        alertFaliure(getItem("FlashMessage"));
    }

    removeLocalStorageFlash();

    if (getItem("OptionState") === "Set") {
        document.getElementById(getItem("OptionName")).click();
    }

    removeLocalStorageOption();

})


// C.O.R.S
// Dashboard Page
function dashboardChart() {

    let chassisNo = document.getElementById("dashboardChart").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            destroyChart(document.getElementById('myChart'));

            var ctx = document.getElementById('myChart').getContext('2d');

            let ltx = document.getElementById('myChart-label');

            updateChart(ctx, ltx, JSON.parse(response), 80);

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Vehicles/assemblyPercentageDetail", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("chassisNo="+chassisNo);

}

function damagedComponents(string) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;
            
            if (response.trim() == "Successful") {
                location.reload();
                setLocalStorageFlash("Successful","MRF Sent Successfully");

            } else {
                
                location.reload();
                setLocalStorageFlash("Error","Error Sending MRF");

            }

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Vehicles/requestDamagedComponents", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(string);

}

// Body Shell Page
function requestShell() {

    if (!validaterequestShell()) {
        alertFaliure("Please Fill All The Fields");
        return;
    }

    let id = [];
    let string = "";
    let cnt = 1;

    let parentNode = document.getElementById("fields");
    let children = parentNode.querySelectorAll("*");

    children.forEach(element => {
        if (element.id && !element.id.search("field")) {
            id.push(element.id);
        }
    });

    id.forEach(element => {
        let type = document.getElementById(`type${element[element.length - 1]}`).value;
        let qty = document.getElementById(`qty${element[element.length - 1]}`).value;
        string = string + `&type${cnt}=${type}&qty${cnt}=${qty}`;
        cnt++;
    });

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response.trim() == "Successful") {

                location.reload();
                setLocalStorageFlash("Successful","Email Sent Successfully");

            } else {
                location.reload();
                setLocalStorageFlash("Error","Error Sending Email");
            }

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Vehicles/shellRequest", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(string);
}

function addShell() {

    let data = validateAddShell();

    if (!data["flag"]) {
        alertFaliure("Please Fill All The Fields");
        return;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;


            if (response.trim() == "Successful") {

                location.reload();
                setLocalStorageFlash("Successful","Shell Added Successfully");

            } else {
                
                location.reload();
                setLocalStorageFlash("Error","Shell Adding Failed");

            }

            setLocalStorageOption("option-two");

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Vehicles/addShell", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("chassisNo="+data["chassisNo"]+"&color="+data["color"]+"&chassisType="+data["chassis"]+"&repair="+data["repair"]+"&paint="+data["paint"]+"&repairDescription="+data["repairDescription"]);
}

function viewShell(chassisNo) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            let innerhtml = popUpInnerhtml(JSON.parse(response));

            let classname = "display-flex-row gap-2"

            popUp("three", "div", classname, innerhtml);

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Vehicles/shellDetail", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("chassisNo="+chassisNo);


}

function startAssembly(chassisNo) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response.trim() == "Successful") {

                document.getElementById("startAssembly").disabled = true;
                location.reload();
                setLocalStorageFlash("Successful",chassisNo + " Moved to Assembly Line");

                conn.send("New Vehicle Arrived to Assembly Line : " + chassisNo );

                // conn.onmessage = function (e) {
                //     let alert = document.getElementById("alert");
                //     alert.classList.remove("hideme");
                //     alert.classList.add("shows");
                //     alert.classList.add("showme");
                //     alert.classList.add("alert-success");
                //     alert.innerHTML = "<i class='icon fa-check-circle margin-right-3'></i>"+e.data;
                // };

            } else {

                location.reload();
                setLocalStorageFlash("Error",response);
                // console.log(response);

            }

            setLocalStorageOption("option-three");

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Vehicles/startAssembly", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("chassisNo="+chassisNo);
    
}

function sendRequest(id,job) {

    let chassisNo = document.getElementById("jobchassis").value;
    let previous = document.getElementById("previous").checked;
    let repairDescription = document.getElementById("re-repairDescription").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response.trim() == "Successful") {

                location.reload();
                setLocalStorageFlash("Successful", "Successfully Re-Requested "+ job +" for " + chassisNo);
                

            } else {

                location.reload();
                setLocalStorageFlash("Error", "Error Re-Requesting "+ job +" for " + chassisNo);

            }

            setLocalStorageOption("option-four");

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Vehicles/requestJobs", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id="+id+"&job="+job+"&chassisNo="+chassisNo+"&previous="+previous+"&repairDescription="+repairDescription);

}

function jobDone(id,job) {
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response.trim() == "Successful") {

                location.reload();
                setLocalStorageFlash("Successful",id + " - " + job + " " + " Job is Completed");
                

            } else {

                location.reload();
                setLocalStorageFlash("Error",response);

            }

            setLocalStorageOption("option-four");

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Vehicles/jobDone", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id="+id+"&job="+job);

}

// Components Page
function createList() {

    if (!validaterequestShell()) {
        alertFaliure("Please Fill All The Fields");
        return;
    }

    let id = [];
    let string = "";
    let cnt = 1;

    let parentNode = document.getElementById("fields");
    let children = parentNode.querySelectorAll("*");

    children.forEach(element => {
        if (element.id && !element.id.search("field")) {
            id.push(element.id);
        }
    });

    id.forEach(element => {
        let type = document.getElementById(`type${element[element.length - 1]}`).value;
        let color = document.getElementById(`color${element[element.length - 1]}`).value;
        let qty = document.getElementById(`qty${element[element.length - 1]}`).value;
        string = string + `&type${cnt}=${type}&color${cnt}=${color}&qty${cnt}=${qty}`;
        cnt++;
    });

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response.trim() == "Successful") {
                location.reload(true);
                setLocalStorageFlash("Successful","Sent Material Request Form");

            } else {
                location.reload(true);
                setLocalStorageFlash("Error","Error Sending Email");
            }

            console.log(response);

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Managers/component", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(string);
}

function changeComponentStatus(chassisNo) {

    let array = {};

    const checkboxes = document.querySelectorAll("#componentStatus");
    checkboxes.forEach(function (checkbox) {
        array[checkbox.value] = checkbox.checked;
    });

    array = JSON.stringify(array);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response.trim() == "Successful") {

                location.reload();
                setLocalStorageFlash("Successful","Status Updated");
                

            } else {

                location.reload();
                setLocalStorageFlash("Error","Status Not Updated");

            }

            setLocalStorageOption("option-two");

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Vehicles/changeComponentStatus", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("status="+array+"&chassisNo="+chassisNo);
}

function component() {

    let chassisNo = document.getElementById("components").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            response = JSON.parse(response);
            
            document.getElementById("chassiNoC").innerHTML = `Chassis No : ${response['vehicles'].ChassisNo}`;
            document.getElementById("colorC").innerHTML = `Color : ${response['vehicles'].Color}`
            document.getElementById("selected").innerHTML = compList(response);

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Vehicles/componentsByChassis", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("chassisNo="+chassisNo);

}

// Dispatch Page
function dispatch() {

    let data = validateDispatch();

    if (!data["flag"]) {
        alertFaliure("Please Fill All The Fields");
        return;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;


            if (response.trim() == "Successful") {

                location.reload();
                setLocalStorageFlash("Successful","Vehicle Dispatched");

            } else {
                
                location.reload();
                setLocalStorageFlash("Error","Error Dispatching Vehicle");

            }

            setLocalStorageOption("option-two");

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Vehicles/dispatch", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("chassisNo="+data["chassisNo"]+"&showroom="+data["showroom"]);
}

// Settings Page
function saveChanges(id, position) {
    let formdata = new FormData();
    formdata.append("id", id);
    formdata.append("image", document.getElementById("image").files[0]);
    formdata.append("firstname", document.getElementById("firstname").value);
    formdata.append("lastname", document.getElementById("lastname").value);
    formdata.append("email", document.getElementById("email").value);
    formdata.append("mobile", document.getElementById("mobile").value);
    formdata.append("nic", document.getElementById("nic").value);
    $.ajax({
        type: 'POST',
        url: 'http://localhost/MicroCAPS/'+position+'s/settings',
        data: formdata,
        processData: false,
        contentType: false,
        success: (response) => {
            if (response.trim() == "Successful") {
                location.reload(true);
                setLocalStorageFlash("Successful","Saved Changes");
            } else {
                location.reload();
                setLocalStorageFlash("Error","Error Saving Changes");
            }
        }
    });
}

function updatePassword() {
    let formdata = new FormData();
    formdata.append("currentPassword", document.getElementById("currentpassword").value);
    formdata.append("newPassword", document.getElementById("newpassword").value);
    formdata.append("confirmPassword", document.getElementById("confirmpassword").value);
    $.ajax({
        type: 'POST',
        url: 'http://localhost/MicroCAPS/Users/updatePassword',
        data: formdata,
        processData: false,
        contentType: false,
        success: (response) => {
            if (response.trim() == "Successful") {
                location.reload(true);
                setLocalStorageFlash("Successful","Password Updated");
            } else {
                location.reload();
                setLocalStorageFlash("Error",response);
            }
        }
    });
}

// Search
function searchByKey(type) {

    let keyword = document.getElementById("searchId").value;
    let searchType = document.getElementById("search-type").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            var response = this.responseText;

            response = JSON.parse(response);
            let innerHTML = "";
            
            switch (type) {
                case 'assembly':
                    innerHTML = assemblylist(response);
                    break;
                case 'pdi':
                    innerHTML = pdilist(response);
                    break;
                case 'dispatch':
                    innerHTML = dispatchlist(response);
                    break;
            }
            
            const vehicleList = document.getElementById("vehicleList");
            vehicleList.innerHTML = innerHTML;

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Vehicles/searchByKey", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("keyword="+keyword+"&searchType="+searchType+"&type="+type);

}

//Alert Success
function alertSuccess(message) {
    let alert = document.getElementById("alert");
    alert.classList.remove("hideme");
    alert.classList.add("shows");
    alert.classList.add("showme");
    alert.classList.add("alert-success");
    alert.innerHTML = "<i class='icon fa-check-circle margin-right-3'></i>"+message;

    setTimeout(() => { 
        alert.classList.add("hideme");
        alert.classList.remove("shows");
        alert.classList.remove("showme");
        alert.classList.remove("alert-success");
    }, 5000);
}

//Alert Faliure
function alertFaliure(message) {
    let alert = document.getElementById("alert");
    alert.classList.remove("hideme");
    alert.classList.add("shows");
    alert.classList.add("showme");
    alert.classList.add("alert-failure");
    alert.innerHTML = "<i class='icon fa-times-circle margin-right-3'></i>"+message;

    setTimeout(() => { 
        alert.classList.add("hideme");
        alert.classList.remove("shows");
        alert.classList.remove("showme");
        alert.classList.remove("alert-failure");
    }, 5000);
}

//Local Storage
function setLocalStoragePDF() {
    localStorage.setItem("PDFState","Set");
}

function setLocalStorageFlash(FlashState,FlashMessage) {
    localStorage.setItem("FlashState",FlashState);
    localStorage.setItem("FlashMessage",FlashMessage);
}

function setLocalStorageOption(OptionName) {
    localStorage.setItem("OptionState","Set");
    localStorage.setItem("OptionName",OptionName);
}

function getItem(key) {
    return localStorage.getItem(key);
}

function removeLocalStoragePDF() {
    localStorage.removeItem("PDFState");
}

function removeLocalStorageFlash() {
    localStorage.removeItem("FlashState");
    localStorage.removeItem("FlashMessage");
}

function removeLocalStorageOption() {
    localStorage.removeItem("OptionState");
    localStorage.removeItem("OptionName");
}

// Form Validations

function validaterequestShell() {
    let form = document.getElementById("request-shell");
    const formData = new FormData(form);

    let type = [];
    let qty = [];

    for (const [key, value] of formData.entries()) {
        if (key.search("type") != -1) {
            type.push(value);
        } else if (key.search("qty") != -1) {
            qty.push(value);
        }
    }

    let flag = [true,true];

    type.forEach((element) => {
        if (element === "") {
            flag[0] = false;
        }
    });

    qty.forEach((element) => {
        if (element == 0) {
            flag[1] = false;
        }
    });

    return (flag[0] && flag[1]);
}

function validateAddShell() {

    let flag = true;

    const chassisNo = document.getElementById("chassisNo");
    let chassisNoLabel = document.getElementById("chassisNo-label");
    const color = document.getElementById("color");
    const chassis = document.getElementById("chassis");
    let repair = document.getElementById("repair").checked;
    let paint = document.getElementById("paint").checked;
    let repairDescription = document.getElementById("repairDescription");
    let repairDescriptionLabel = document.getElementById("repairDescription-label");


    const regex = /^CN\d{9}[A-Z]$/;

    if (chassisNo.value === "") {
        chassisNo.classList.add("form-control-red");
        chassisNo.focus({ preventScroll: true });
        chassisNoLabel.classList.add("red");
        chassisNoLabel.innerHTML = "Chassis Number is Required";
        flag = false;
    } else if (!regex.test(chassisNo.value)) {
        chassisNo.classList.add("form-control-red");
        chassisNo.focus({ preventScroll: true });
        chassisNoLabel.classList.add("red");
        chassisNoLabel.innerHTML = "Invalid Chassis Number";
        flag = false;
    }

    if (color.value === "") {
        color.classList.add("form-control-red");
        color.classList.add("text-red");
        color.classList.remove("text-gray");
        flag = false;
    }

    if (chassis.value === "") {
        chassis.classList.add("form-control-red");
        chassis.classList.add("text-red");
        chassis.classList.remove("text-gray");
        flag = false;
    }

    if (repair) {
        if (repairDescription.value === "") {
            repairDescription.classList.add("form-control-red");
            repairDescriptionLabel.classList.add("red");
            flag = false;
        }
    }

    return {"flag":flag, "chassisNo":chassisNo.value,"color":color.value,"chassis":chassis.value,"repair":repair,"paint":paint,"repairDescription":repairDescription.value};

}

function validateDispatch() {

    let flag = true;

    const chassisNo = document.getElementById("chassisNo");
    const showroom = document.getElementById("showroom");

    if (showroom.value === "") {
        showroom.classList.add("form-control-red");
        showroom.classList.remove("text-gray");
        showroom.classList.add("text-red");
        flag = false;
    }

    if (chassisNo.value === "") {
        chassisNo.classList.remove("form-control-blue");
        chassisNo.classList.add("form-control-red");
        chassisNo.classList.remove("text-blue");
        chassisNo.classList.add("text-red");
        flag = false;
    }

    return {"flag":flag, "chassisNo":chassisNo.value,"showroom":showroom.value};

}

//Pop Up

function popUp (parent, element, classname, innerhtml) {

    const parentNode = document.getElementById(parent);

    const overlay = parentNode.querySelector("#overlay");
    const popcon = parentNode.querySelector("#pop-con");

    overlay.classList.add('visible');
    popcon.classList.add('pop');

    const div = document.createElement(element);
    div.className = classname;
    div.innerHTML = innerhtml;
    popcon.appendChild(div);

    const cancelbtn = parentNode.querySelector("#cancel");
    cancelbtn.onclick = () => {
        location.reload();
        setLocalStorageOption("option-" + parent);
    };

}

function popUpInnerhtml (values) {
    let repaircnt = paintcnt = 1;
    let rC = pC = 0;
    let status = repairDetails = paintDetails = repairNumbers = paintNumbers = "";

    if (!values['repairDetails']) {
        repairDetails = `<div class="repair display-flex-column gap-1" id="NoRepair">
                            <div>
                                <div class="text-darkblue font-weight font-size-14">No Repairs</div>
                            </div>
                        </div>`
    } else {
        values['repairDetails'].forEach(value => {
            if (value.Status === "NC") {
                status = "Not Completed";
            }  else {
                rC++;
                status = "Completed";
            }
            repairDetails = repairDetails + 
                `<div class="repair display-flex-column gap-1 ${repaircnt === 1 ? "" : "display-none" }" id="Repair${repaircnt++}">
                    <div>
                        <div class="text-darkblue font-weight font-size-14">REPAIR ID</div>
                        <div class="detail">${value.RepairId}</div>
                    </div>
                    <div>
                        <div class="text-darkblue font-weight font-size-14">REPAIR DESCRIPTION</div>
                        <div class="detail">${value.RepairDescription}</div>
                    </div>
                    <div>
                        <div class="text-darkblue font-weight font-size-14">REQUEST DATE</div>
                        <div class="detail">${value.RequestDate}</div>
                    </div>
                    <div>
                        <div class="text-darkblue font-weight font-size-14">STATUS DATE</div>
                        <div class="detail">${status}</div>
                    </div>
                </div>`;
        });
    }

    for (let i = 1; i < repaircnt; i++) {
        repairNumbers = repairNumbers + `<div class="text-darkblue font-weight font-size-14 cursor-pointer repairnumbers ${i === 1 ? "active" : "" }" onclick="show(event, 'Repair${i}', 'repair')">${i}</div>`;
    }

    if (!values['paintDetails']) {
        paintDetails = `<div class="repair display-flex-column gap-1" id="NoRepair">
                            <div>
                                <div class="text-darkblue font-weight font-size-14">No Paint Works</div>
                            </div>
                        </div>`
    } else {
        values['paintDetails'].forEach(value => {
            if (value.Status === "NC") {
                status = "Not Completed";
            }  else {
                status = "Completed";
                pC++;
            }
            paintDetails = paintDetails + 
                `<div class="paint display-flex-column gap-1 ${paintcnt === 1 ? "" : "display-none" }" id="Paint${paintcnt++}">
                    <div>
                        <div class="text-darkblue font-weight font-size-14">PAINT ID</div>
                        <div class="detail">${value.PaintId}</div>
                    </div>
                    <div>
                        <div class="text-darkblue font-weight font-size-14">REQUEST DATE</div>
                        <div class="detail">${value.RequestDate}</div>
                    </div>
                    <div>
                        <div class="text-darkblue font-weight font-size-14">STATUS DATE</div>
                        <div class="detail">${status}</div>
                    </div>
                </div>`;
        });
    }

    for (let i = 1; i < paintcnt; i++) {
        paintNumbers = paintNumbers + `<div class="text-darkblue font-weight font-size-14 cursor-pointer paintnumbers ${i === 1 ? "active" : "" }" onclick="show(event, 'Paint${i}', 'paint')">${i}</div>`;
    }

    if (rC === repaircnt-1) {
        ricon = "fa-check-circle";
        rstatusColor = "status-green";
    } else {
        ricon = "fa-times-circle";
        rstatusColor = "status-red";
    }

    if (pC === paintcnt-1) {
        picon = "fa-check-circle";
        pstatusColor = "status-green";
    } else {
        picon = "fa-times-circle";
        pstatusColor = "status-red";
    }

    if (rC === repaircnt-1 && pC === paintcnt-1) {
        disable = "";
    } else {
        disable = "disabled";
    }

    let innerhtml = `<div class="">
                        <img src="http://localhost/MicroCAPS/public/images/chassis-vertical.jpg" class="width-rem-12p5 paddingy-3 paddingx-5" alt="${values['shellDetails'].ModelName}' ${values['shellDetails'].Color}">
                    </div>
                    <div class="paddingy-3 padding-right-5">
                        <div class="display-flex-row gap-1">
                            <div>
                                <label class="text-blue description">SHELL DESCRIPTION</label>
                                <div class="display-flex-column gap-1 border-gray padding-4 width-rem-15p7">
                                    <div>
                                        <div class="text-darkblue font-weight font-size-14">MODEL</div>
                                        <div class="detail">${values['shellDetails'].ModelName}</div>
                                    </div>
                                    <div>
                                        <div class="text-darkblue font-weight font-size-14">COLOR</div>
                                        <div class="detail">${values['shellDetails'].Color}</div>
                                    </div>
                                    <div>
                                        <div class="text-darkblue font-weight font-size-14">CHASSIS NO</div>
                                        <div class="detail">${values['shellDetails'].ChassisNo}</div>
                                    </div>
                                    <div>
                                        <div class="text-darkblue font-weight font-size-14">ARRIVAL DATE</div>
                                        <div class="detail">${values['shellDetails'].ArrivalDate}</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="text-blue description">REPAIR DETAILS</label>
                                <div class="display-flex-row gap-1 border-gray padding-4 width-rem-15p7">
                                        ${repairDetails}
                                </div>
                                <div class="display-flex-row gap-1 justify-content-end">
                                    ${repairNumbers}
                                </div>
                            </div>
                        </div>
                        <div class="display-flex-row gap-1">
                            <div>
                                <label class="text-blue description">PAINT DETAILS</label>
                                <div class="display-flex-row gap-1 border-gray padding-4 width-rem-15p7">
                                        ${paintDetails}
                                </div>
                                <div class="display-flex-row gap-1 justify-content-end">
                                    ${paintNumbers}
                                </div>
                            </div>
                            <div>
                                <label class="text-blue description visibility-hidden">OVERALL</label>
                                <div class="display-flex-column gap-1 justify-content-center border-gray padding-4 width-rem-15p7">
                                    <div class="display-flex-row justify-content-between">
                                        <div class="display-flex-row gap-0p5 ${rstatusColor}">
                                            <i class='icon ${ricon}'></i>
                                            <div class="${rstatusColor} font-weight font-size-14">REPAIR</div>
                                        </div>
                                        <div class="detail lette-spacing-5">${rC}/${repaircnt-1}</div>
                                    </div>
                                    <div class="display-flex-row justify-content-between">
                                        <div class="display-flex-row gap-0p5 ${pstatusColor}">
                                            <i class='icon ${picon}'></i>
                                            <div class="${pstatusColor} font-weight font-size-14">PAINT</div>
                                        </div>
                                        <div class="detail lette-spacing-5">${pC}/${paintcnt-1}</div>
                                    </div>
                                    <div>
                                        <label class="form-control-checkbox display-flex-row justify-content-between align-items-center font-size-14 text-darkblue" id="checkbox">
                                            Proceed to Assembly Line
                                            <input type="checkbox"
                                                    id="startAssembly"
                                                    name="assembly"
                                                    onChange="startAssembly('${values['shellDetails'].ChassisNo}','${values['shellDetails'].Color}')"
                                                    value="Yes"
                                                    ${disable}>
                                            <div class="checkmark-small"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>`;

                    return innerhtml;
}

// HTML
function compList(values) {

    let count = 1;

    innerHTML = `<div class="display-flex-row gap-5">`;

    values['components'].forEach(value => {

        if (count === 1) {
            innerHTML = innerHTML + '<div class="display-flex-column gap-1">';
        }

        if (value.Status == 'R') {
            checked = 'checked';
            disabled = 'disabled';
        } else {
            checked = '';
            disabled = '';
        }

        innerHTML = innerHTML + `<div class="display-flex-row justify-content-between border-bottom width-rem-12">
                    <div class="padding-bottom-3 font-size">${value.PartName}</div>
                    <label class="form-control-checkbox" id="checkbox">
                        <input type="checkbox"
                                id="componentStatus"
                                name="status"
                                value="${value.PartNo}" 
                                ${disabled}
                                ${checked}>
                        <div class="checkmark-small-blue"></div>
                    </label>
                </div>`;
        
        count++;

        if (count == 51) {
            innerHTML = innerHTML + '</div>';
            count = 1;
        }
    });

    innerHTML = innerHTML + `</div>
        <div class="text-center margin-top-3">
            <button class="btn btn-primary" type="button"  onclick="changeComponentStatus('${values['vehicles'].ChassisNo}')">
                Mark as Received
            </button>
        </div>`;

    return innerHTML;

}

// Charts

function updateChart(ctx, ltx, data, cutout = 50) {

    let done = data['overall'].completed/(parseInt(data['overall'].completed) + parseInt(data['overall'].pending))*100;
    let ongoing = data['overall'].pending/(parseInt(data['overall'].completed) + parseInt(data['overall'].pending))*100;

    let chartGrid = cutout == 50 ? 'chart-grid-stage-add' : 'chart-grid-add';

    if (done == 0) {
        ltx.innerHTML = '0%';
        ltx.classList.add(chartGrid + '-1');
    } else if (done == 100) {
        ltx.innerHTML = '100%';
        ltx.classList.add(chartGrid + '-3');
    } else {
        ltx.innerHTML = Math.floor(done) + '%';
        ltx.classList.add(chartGrid + '-2');
    }

    var chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Done', 'Ongoing'],
            datasets: [{
                data: [done, ongoing],
                backgroundColor: ['#017EFA', '#51CBFF']
            }]
        },
        options: {
        plugins: {
            legend: {
                display: false
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        cutout: cutout
    }
    });
}

function destroyChart(ctx) {

    var chart = Chart.getChart(ctx);

    chart.destroy();

}

//searchGenerates
function assemblylist(response) {

    let innerHTML = '';

    if (!response['assemblyDetails']) {
        innerHTML = `<div class="display-flex-row justify-content-center align-items-center border-bottom width-100 paddingy-6">
                        <div class="font-weight">No Details</div>
                    </div>`
    } else {

        innerHTML = `<div class="display-flex-row flex-wrap justify-content-between">`

        response['assemblyDetails'].forEach((value, index) => {

            let word = 'On Assembly';
            let css = 'green';

            let CurrentStatus = stage(value.CurrentStatus);

            if (!CurrentStatus) {
                CurrentStatus = stage(response['holdStage'][index].StageNo);
                word = 'On Hold';
                css = 'red';
            }

            innerHTML = innerHTML + 
            `<a href="http://localhost/MicroCAPS/managers/assembly/${value.ChassisNo}">
                <div class="carcard">
                    <div class="cardhead">
                        <div class="cardid">
                            <div class="carmodel">${value.ModelName}</div>
                            <div class="chassisno">${value.ChassisNo}</div>
                        </div>
                        <div class="toolstatuscolor">
                            <div class="status-circle status-${css}-circle"></div>
                        </div>
                    </div>
                    <div class="carpicbox">
                        <img src="http://localhost/MicroCAPS/public/images/cars/${value.ModelName} ${value.Color}.png" class="carpic" alt="${value.ModelName}${value.Color}">
                    </div>
                    <div class="carstatus ${css}">${word}</div>
                    <div class="arrivaldate">Stage: ${CurrentStatus}</div>
                </div>
            </a>`;  
        });

        innerHTML = innerHTML + `</div>`;
    }

    return innerHTML;
}

function stage(str) {

    if (str == 'S1') {
        return 'Stage 01';
    } else if (str == 'S2') {
        return 'Stage 02';
    } else if (str == 'S3') {
        return 'Stage 03';
    } else if (str == 'S4') {
        return 'Stage 04';
    } else {
        return false;
    }

}

function pdilist(response) {
    let innerHTML = '';

    if (!response['onPDIVehicles']) {
        innerHTML = `<div class="display-flex-row justify-content-center align-items-center border-bottom width-100 paddingy-6">
                        <div class="font-weight">No Details</div>
                    </div>`
    } else {

        innerHTML = `<div class="display-flex-row flex-wrap justify-content-between">`

        response['onPDIVehicles'].forEach(value => {

            if (value.TesterId == 'NA') {
                word = 'Not Started';
                css = 'red';
            } else {
                if (value.PDIStatus == 'NC') {
                    word = 'In Progress';
                    css = 'orange';
                } else {
                    word = 'Completed';
                    css = 'green';
                }
            }

            innerHTML = innerHTML +
            `<a href="http://localhost/MicroCAPS/managers/pdi/${value.ChassisNo}">
                <div class="carcard">
                    <div class="cardhead">
                        <div class="cardid">
                            <div class="carmodel">${value.ModelName}</div>
                            <div class="chassisno">${value.ChassisNo}</div>
                        </div>
                        <div class="toolstatuscolor">
                            <div class="status-circle status-${css}-circle"></div>
                        </div>
                    </div>
                    <div class="carpicbox">
                        <img src="http://localhost/MicroCAPS/public/images/cars/${value.ModelName} ${value.Color}.png" class="carpic" alt="${value.ModelName}${value.Color}">
                    </div>
                    <div class="carstatus ${css}">${word}</div>
                    <div class="arrivaldate">Stage: ${value.CurrentStatus}</div>
                </div>
            </a>`;
 
        });

        innerHTML = innerHTML + `</div>`;
    }

    return innerHTML;
}

function dispatchlist(response) {
    let innerHTML = '';

    if (!response['dispatchDetails']) {
        innerHTML = `<div class="display-flex-row justify-content-center align-items-center border-bottom width-100 paddingy-6">
                        <div class="font-weight">No Details</div>
                    </div>`
    } else {

        innerHTML = `<div class="display-flex-row flex-wrap justify-content-between">`

        response['dispatchDetails'].forEach(value => {

            innerHTML = innerHTML +
            `<a href="http://localhost/MicroCAPS/managers/dispatch/${value.ChassisNo}">
                <div class="carcard">
                    <div class="cardhead">
                        <div class="cardid">
                            <div class="carmodel">${value.ModelName}</div>
                            <div class="chassisno">${value.ChassisNo}</div>
                        </div>
                    </div>
                    <div class="carpicbox">
                        <img src="http://localhost/MicroCAPS/public/images/cars/${value.ModelName} ${value.Color}.png" class="carpic" alt="${value.ModelName}${value.Color}">
                    </div>
                    <div class="carstatus green">Show Room:${value.ReleaseDate}</div>
                    <div class="arrivaldate">Stage: ${value.ReleaseDate}</div>
                </div>
            </a>`;
 
        });

        innerHTML = innerHTML + `</div>`;
    }

    return innerHTML;
}
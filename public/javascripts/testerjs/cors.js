// FLASH MESSAGE

$(document).ready(() => {

    if (getItem("FlashState") === "Successful") {
        alertSuccess(getItem("FlashMessage"));
    } else if (getItem("FlashState") === "Error") {
        alertFaliure(getItem("FlashMessage"));
    }

    removeLocalStorage()

})


// CHANGE PDI STATUS

function addPDI(ChassisNo,CheckId, Result) {
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response.trim() == "Successful") {
                location.reload();
                setLocalStorage("Successful","Status Changed Successfully");
            } else {
                location.reload();
                setLocalStorage("Error","Error Completing Job");
            }
        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Testers/addPDI", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("ChassisNo="+ChassisNo+"&CheckId="+CheckId+"&Result="+Result);
}


// CHANGE ALL PDI STATUSES

function selectAllPDI(ChassisNo, CategoryId, Result) {
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response.trim() == "Successful") {
                location.reload();
                setLocalStorage("Successful","Status Changed Successfully");
            } else {
                location.reload();
                setLocalStorage("Error","Error Completing Job");
            }
        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Testers/selectAllPDI", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("ChassisNo="+ChassisNo+"&CategoryId="+CategoryId+"&Result="+Result);
}


// ADD A VEHICLE TO MY TASKS

function addTask(ChassisNo, TesterId) {
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response.trim() == "Successful") {
                location.reload();
                setLocalStorage("Successful","Vehicle Added Successfully");
            } else {
                location.reload();
                setLocalStorage("Error","Error Adding Vehicle");
            }
        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Testers/addTask", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("ChassisNo="+ChassisNo+"&TesterId="+TesterId);
}


// REMOVE A VEHICLE FROM MY TASKS

function removeTask(ChassisNo) {
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response.trim() == "Successful") {
                location.reload();
                setLocalStorage("Successful","Vehicle Removed Successfully");
            } else {
                location.reload();
                setLocalStorage("Error","Error Removing Vehicle");
            }
        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Testers/removeTask", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("ChassisNo="+ChassisNo);
}


// MARK TASK AS COMPLETED

function completeTask(ChassisNo, TesterId) {
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response.trim() == "Successful") {
                window.location.replace("http://localhost/MicroCAPS/Testers/mytasks/"+TesterId);
                setLocalStorage("Successful","Task Completed Successfully");
            } else if (response.trim() == "pdinotcompleted") {
                location.reload();
                setLocalStorage("Error","Check PDI List Again");
            } else if (response.trim() == "defectnotcompleted") {
                location.reload();
                setLocalStorage("Error","Correct All defects first.");
            } else {
                location.reload();
                setLocalStorage("Error","Task Unsuccessful");
            }
        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Testers/completeTask", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("ChassisNo="+ChassisNo);
}


// EDIT PROFILE DETAILS

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
                setLocalStorage("Successful","Saved Changes");
            } else {
                location.reload();
                setLocalStorage("Error","Error Saving Changes");
            }
        }
    });
}


// DELETE DEFECT

  function deleteDefect(chassisno, defectno) {
    var xhr = new XMLHttpRequest();
  
    xhr.open("DELETE", "http://localhost/MicroCAPS/Testers/delete_defect/" + chassisno + "/" + defectno, true);
  
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
    xhr.send("ChassisNo=" + chassisno + "&DefectNo=" + defectno);
  
    xhr.onload = function() {
      if (this.readyState == 4 && xhr.status == 200) {
        var response = xhr.responseText;
        if (response.trim() == "Successful") {
            location.reload();
            setLocalStorage("Successful", "Defect Deleted Successfully");
            window.onload = function() {
                document.getElementById("chg-pass").click();
            };
        } else {
          location.reload();
          setLocalStorage("Error", "Error Deleting Defect");
        }
      } else {
        alert("Error deleting PDI.");
      }
    };
  }


// ADD DEFECT

function addDefect() {
    let formdata = new FormData();
    var chassisno = document.getElementById("ChassisNo").value;

    formdata.append("ChassisNo", document.getElementById("ChassisNo").value);
    formdata.append("DefectNo", document.getElementById("DefectNo").value);
    formdata.append("InspectionDate", document.getElementById("InspectionDate").value);
    formdata.append("EmployeeID", document.getElementById("EmployeeID").value);
    formdata.append("RepairDescription", document.getElementById("RepairDescription").value);
    formdata.append("ReCorrection", document.getElementById("ReCorrection").value);
    $.ajax({
        type: 'POST',
        url: 'http://localhost/MicroCAPS/Testers/defect_sheet/'+chassisno,
        data: formdata,
        processData: false,
        contentType: false,
        success: (response) => {
            if (response.trim() == "Successful") {
                location.reload();
                setLocalStorage("Successful","Defect Added Successfully");
            } else if (response.trim() == "defectexists") {
                location.reload();
                setLocalStorage("Error","Defect Number Already Exists");
            } else if (response.trim() == "olderdate") {
                location.reload();
                setLocalStorage("Error","Date must be in last 7 days.");
            } else if (response.trim() == "futuredate") {
                location.reload();
                setLocalStorage("Error","Date cannot be in the future.");
            } else if (response.trim() == "invaliddate") {
                location.reload();
                setLocalStorage("Error","Date cannot be empty.");
            } else if (response.trim() == "emptydefectno") {
                location.reload();
                setLocalStorage("Error","Defect number cannot be empty.");
            } else if (response.trim() == "emptydefectdesc") {
                location.reload();
                setLocalStorage("Error","Repair description cannot be empty.");
            } else {
                location.reload();
                setLocalStorage("Error","Error Adding Defect");
            }
        }
    });
}


// EDIT DEFECT

function editDefect(chassisno, defectno) {
    let formdata = new FormData();
    formdata.append("ChassisNo", document.getElementById("ChassisNo").value);
    formdata.append("DefectNo", document.getElementById("DefectNo").value);
    formdata.append("InspectionDate", document.getElementById("InspectionDate").value);
    formdata.append("EmployeeID", document.getElementById("EmployeeID").value);
    formdata.append("RepairDescription", document.getElementById("RepairDescription").value);
    formdata.append("ReCorrection", document.getElementById("ReCorrection").value);
    $.ajax({
        type: 'POST',
        url: 'http://localhost/MicroCAPS/Testers/edit_defect/'+chassisno+'/'+defectno,
        data: formdata,
        processData: false,
        contentType: false,
        success: (response) => {
            if (response.trim() == "Successful") {
                window.location.replace("http://localhost/MicroCAPS/Testers/defect_sheet/"+chassisno);
                setLocalStorage("Successful","Saved Changes Successfully");
            } else if (response.trim() == "olderdate") {
                location.reload();
                setLocalStorage("Error","Date must be in last 7 days.");
            } else if (response.trim() == "futuredate") {
                location.reload();
                setLocalStorage("Error","Date cannot be in the future.");
            } else if (response.trim() == "invaliddate") {
                location.reload();
                setLocalStorage("Error","Date cannot be empty.");
            } else if (response.trim() == "emptydefectdesc") {
                location.reload();
                setLocalStorage("Error","Defect description cannot be empty.");
            } else {
                location.reload();
                setLocalStorage("Error","Error Saving Changes");
            }
        }
    });
}

// SEARCH PDI

function searchPDI(){
    let keyword = document.getElementById("searchId").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            var response = this.responseText;

            response = JSON.parse(response);
            let innerHTML = "";

            innerHTML = pdilist(response);

            const vehicleresults = document.getElementById("vehicleList");
            vehicleresults.innerHTML = innerHTML;

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Testers/searchPDI", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("keyword="+keyword);
}


// SEARCH GENERATES PDI VEHICLE LIST

function pdilist(response) {
    if (!response['onPDIVehicles']) {
        innerHTML = `<div class="display-flex-row justify-content-center align-items-center border-bottom width-100 paddingy-6">
                        <div class="font-weight">No Details</div>
                    </div>`
    } else {

        innerHTML = `<div class="vehicle-detail-board  margin-bottom-4">
                                    <div class="vehicle-data-board justify-content-evenly">`
        
        response['onPDIVehicles'].forEach(value => {
            if (value.CurrentStatus == 'RR') {
                val = 'Ready to Test';
            }

            innerHTML = innerHTML +
            `<a href="http://localhost/MicroCAPS/testers/pdiresults/${value.ChassisNo}">
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
                <div class="carstatus green"> PDI </div>
                <div class="arrivaldate">Stage: ${val}</div>
            </div>
            </a>`
        });
        innerHTML = innerHTML + `</div></div>`;
    }
    return innerHTML;
}


// SEARCH PDI

function searchTask(id){
    let keyword = document.getElementById("searchId").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            var response = this.responseText;

            response = JSON.parse(response);
            let innerHTML = "";

            innerHTML = tasklist(response);

            const vehicleresults = document.getElementById("vehicleList");
            vehicleresults.innerHTML = innerHTML;

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Testers/searchTask", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("keyword="+keyword+"&id="+id);
}


// SEARCH GENERATES PDI VEHICLE LIST

function tasklist(response) {
    if (!response['onPDIVehicles']) {
        innerHTML = `<div class="display-flex-row justify-content-center align-items-center border-bottom width-100 paddingy-6">
                        <div class="font-weight">No Details</div>
                    </div>`
    } else {

        innerHTML = `<div class="vehicle-detail-board  margin-bottom-4">
                                    <div class="vehicle-data-board justify-content-evenly">`
        
        response['onPDIVehicles'].forEach(value => {
            if (value.CurrentStatus == 'RR') {
                val = 'Ready to Test';
            }

            innerHTML = innerHTML +
            `<a href="http://localhost/MicroCAPS/testers/pdi/${value.ChassisNo}">
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
                <div class="carstatus green"> PDI </div>
                <div class="arrivaldate">Stage: ${val}</div>
            </div>
            </a>`
        });
        innerHTML = innerHTML + `</div></div>`;
    }
    return innerHTML;
}


// SEARCH TASK MANAGER

function searchTaskM(id){
    let keyword = document.getElementById("searchId").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            var response = this.responseText;

            response = JSON.parse(response);
            let innerHTML = "";

            innerHTML = taskmlist(response, id);

            const vehicleresults = document.getElementById("vehicleList");
            vehicleresults.innerHTML = innerHTML;

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Testers/searchTaskM", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("keyword="+keyword);
}


// SEARCH GENERATES TASK MANAGER

function taskmlist(response, id) {
    if (!response['onPDIVehicles']) {
        innerHTML = `<div class="display-flex-row justify-content-center align-items-center border-bottom width-100 paddingy-6">
                        <div class="font-weight">No Details</div>
                    </div>`
    } else {

        innerHTML = `<div class="vehicle-detail-board  margin-bottom-4">
                                    <div class="vehicle-data-board justify-content-evenly">`
        
        response['onPDIVehicles'].forEach(value => {
            if (value.CurrentStatus == 'RR') {
                val = 'Ready to Test';
            }

                check_1 = "";
                check_2 = value.TesterId;
                testername = "";

                if(check_2 == null){
                    testername = "None";
                } else {
                    response['testers'].forEach(value_2 => {
                        if(value_2.EmployeeId == check_2){
                            testername = value_2.Firstname.concat(" ", value_2.Lastname);
                        }
                    });
                    if(check_2 == id){
                        check_1 = "checked";
                    }
                }

            innerHTML = innerHTML +
            `<div class="carcard">
            <div class="cardhead">
                <div class="cardid">
                    <div class="carmodel">${value.ModelName}</div>
                    <div class="chassisno">${value.ChassisNo}</div>
                </div>
            </div>
            <div class="carpicbox">
                <img src="http://localhost/MicroCAPS/public/images/cars/${value.ModelName} ${value.Color}.png" class="carpic" alt="${value.ModelName}${value.Color}">
            </div>
            <div class="carstatus green"> PDI </div>
            <div class="arrivaldate margin-top-1">Assigned to: ${testername}</div>
            <div class="mytasks font-size-13 display-flex-row align-items-center margin-top-2 margin-bottom-0 marginx-0">
                <div>
                    <label class="form-control-checkbox">
                        <input type="checkbox"
                                id=""
                                name=""
                                onChange="  if (this.checked) { 
                                    addTask('${value.ChassisNo}', '${id}')
                                }else{
                                    removeTask('${value.ChassisNo}')
                                }"
                                ${check_1}>
                        <div class="checkmark-small"></div>
                    </label>
                </div>
                <div class="padding-left-2">Add to My Tasks</div>
            </div>
        </div>`
        });
        innerHTML = innerHTML + `</div></div>`;
    }
    return innerHTML;
}


// SEARCH SAMINDU

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
    xhttp.open("POST", "http://localhost/MicroCAPS/Testers/searchByKey", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("keyword="+keyword+"&searchType="+searchType+"&type="+type);

}


// SETTINGS

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
                setLocalStorage("Successful","Password Updated");
            } else {
                location.reload();
                setLocalStorage("Error",response);
            }
        }
    });
}


// SEARCH GENERATES

function assemblylist(response) {

    let innerHTML = '';

    if (!response['assemblyDetails']) {
        innerHTML = `<div class="display-flex-row justify-content-center align-items-center border-bottom width-100 paddingy-6">
                        <div class="font-weight">No Details</div>
                    </div>`
    } else {

        innerHTML = `<div class="display-flex-row flex-wrap justify-content-between">`

        response['assemblyDetails'].forEach(value => {

            let word = 'On Assembly';
            let css = 'green';

            let CurrentStatus = value.CurrentStatus.split("-");

            if (CurrentStatus[0] == 'S1') {
                CurrentStatus[0] = 'Stage 01';
            } else if (CurrentStatus[0] == 'S2') {
                CurrentStatus[0] = 'Stage 02';
            } else if (CurrentStatus[0] == 'S3') {
                CurrentStatus[0] = 'Stage 03';
            } else if (CurrentStatus[0] == 'S4') {
                CurrentStatus[0] = 'Stage 04';
            } else if (CurrentStatus[0] == 'H') {
                CurrentStatus[0] = 'Hold';
            } 
            
            if (CurrentStatus.length === 2) {
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
                    <div class="arrivaldate">Stage: ${CurrentStatus[0]}</div>
                </div>
            </a>`;  
        });

        innerHTML = innerHTML + `</div>`;
    }

    return innerHTML;
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

function setLocalStorage(FlashState,FlashMessage) {
    localStorage.setItem("FlashState",FlashState);
    localStorage.setItem("FlashMessage",FlashMessage);
}

function getItem(key) {
    return localStorage.getItem(key);
}

function removeLocalStorage() {
    localStorage.removeItem("FlashState");
    localStorage.removeItem("FlashMessage");
}
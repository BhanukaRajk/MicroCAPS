// Flash Message

$(document).ready(() => {

    if (getItem("FlashState") === "Successful") {
        alertSuccess(getItem("FlashMessage"));
    } else if (getItem("FlashState") === "Error") {
        alertFaliure(getItem("FlashMessage"));
    }

    removeLocalStorage()

})


// Change PDI Status

function addPDI(ChassisNo,CheckId, Result) {
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response == "Successful") {
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

// Add a Vehicle to My Tasks

function addTask(ChassisNo, TesterId) {
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response == "Successful") {
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


// Remove a Vehicle from My Tasks

function removeTask(ChassisNo) {
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response == "Successful") {
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


// Edit Profile Details

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
            if (response == "Successful") {
                location.reload(true);
                setLocalStorage("Successful","Saved Changes");
            } else {
                location.reload();
                setLocalStorage("Error","Error Saving Changes");
            }
        }
    });
}

// Delete Defect

  function deleteDefect(chassisno, defectno) {
    var xhr = new XMLHttpRequest();
  
    xhr.open("DELETE", "http://localhost/MicroCAPS/Testers/delete_defect/" + chassisno + "/" + defectno, true);
  
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
    xhr.send("ChassisNo=" + chassisno + "&DefectNo=" + defectno);
  
    xhr.onload = function() {
      if (this.readyState == 4 && xhr.status == 200) {
        var response = xhr.responseText;
        if (response == "Successful") {
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

// Add Defect

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
            if (response == "Successful") {
                location.reload();
                setLocalStorage("Successful","Defect Added Successfully");
            } else if (response == "defectexists") {
                location.reload();
                setLocalStorage("Error","Defect Number Already Exists");
            } else if (response == "invaliddate") {
                location.reload();
                setLocalStorage("Error","Invalid Date");
            } else {
                location.reload();
                setLocalStorage("Error","Error Adding Defect");
            }
        }
    });
}

// Edit Defect

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
            if (response == "Successful") {
                window.location.replace("http://localhost/MicroCAPS/Testers/defect_sheet/"+chassisno);
                setLocalStorage("Successful","Saved Changes");
            } else if (response == "invaliddate") {
                location.reload();
                setLocalStorage("Error","Invalid Date");
            } else {
                location.reload();
                setLocalStorage("Error","Error Saving Changes");
            }
        }
    });
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
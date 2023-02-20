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

            if (response == "Successful") {

                location.reload();
                setLocalStorageFlash("Successful","Email Sent Successfully");

            } else {
                location.reload();
                setLocalStorageFlash("Error","Error Sending Email");
            }

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Managers/shellRequest", true);
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

            if (response == "Successful") {

                location.reload();
                setLocalStorageFlash("Successful","Shell Added Successfully");

            } else {
                
                location.reload();
                setLocalStorageFlash("Error","Shell Adding Failed");

            }

            setLocalStorageOption("option-two");

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Managers/addShell", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("chassisNo="+data["chassisNo"]+"&color="+data["color"]+"&chassisType="+data["chassis"]+"&repair="+data["repair"]+"&paint="+data["paint"]+"&repairDescription="+data["repairDescription"]);
}

function sendRequest(id,job) {

    let chassisNo = document.getElementById("jobchassis").value;
    let previous = document.getElementById("previous").checked;
    let repairDescription = document.getElementById("re-repairDescription").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response == "Successful") {

                location.reload();
                setLocalStorageFlash("Successful", "Successfully Re-Requested "+ job +" for " + chassisNo);
                

            } else {

                location.reload();
                setLocalStorageFlash("Error", "Error Re-Requesting "+ job +" for " + chassisNo);

            }

            setLocalStorageOption("option-four");

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Managers/RequestJobs", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id="+id+"&job="+job+"&chassisNo="+chassisNo+"&previous="+previous+"&repairDescription="+repairDescription);

}

function jobDone(id,job) {
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response == "Successful") {

                location.reload();
                setLocalStorageFlash("Successful",id + " - " + job + " " + " Job is Completed");
                

            } else {

                location.reload();
                setLocalStorageFlash("Error",response);

            }

            setLocalStorageOption("option-four");

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Managers/jobDone", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id="+id+"&job="+job);

}

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
                setLocalStorageFlash("Successful","Saved Changes");
            } else {
                location.reload();
                setLocalStorageFlash("Error","Error Saving Changes");
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

//Local Storage
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
        flag = false;
    }

    if (chassis.value === "") {
        chassis.classList.add("form-control-red");
        flag = false;
    }

    return {"flag":flag, "chassisNo":chassisNo.value,"color":color.value,"chassis":chassis.value,"repair":repair,"paint":paint,"repairDescription":repairDescription.value};

}

const cancel = document.getElementById("cancel");

cancel?.addEventListener("click", () => {
    location.reload();
    setLocalStorageOption("option-four")
});
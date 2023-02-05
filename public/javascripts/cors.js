
// Flash Message
$(document).ready(() => {

    if (getItem("FlashState") === "Successful") {
        alertSuccess(getItem("FlashMessage"));
    } else if (getItem("FlashState") === "Error") {
        alertFaliure(getItem("FlashMessage"));
    }

    removeLocalStorage()

})

// C.O.R.S
function requestShell() {

    let array = [];
    let cnt = 1;

    while (document.getElementById(`type${cnt}`)) {
        let type = document.getElementById(`type${cnt}`).value;
        let qty = document.getElementById(`qty${cnt}`).value;
        array.push({ type, qty });
        cnt++;
    }

    let string = "";
    cnt = 1;

    array.forEach(element => {
        string = string + `&type${cnt}=${element.type}&qty${cnt}=${element.qty}`;
        cnt++;
    });

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response == "Successful") {

                location.reload();
                setLocalStorage("Successful","Email Sent Successfully");

            } else {
                location.reload();
                setLocalStorage("Error","Error Sending Email");
            }

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Managers/shellRequest", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(string);
}

function addShell() {

    let chassisNo = document.getElementById("chassisNo").value;
    let color = document.getElementById("color").value;
    let chassis = document.getElementById("chassis").value;
    let repair = document.getElementById("repair").checked;
    let paint = document.getElementById("paint").checked;
    let repairDescription = document.getElementById("repairDescription").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response == "Successful") {

                location.reload();
                setLocalStorage("Successful","Shell Added Successfully");

            } else {
                
                location.reload();
                setLocalStorage("Error","Shell Adding Failed");

            }

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Managers/addShell", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("chassisNo="+chassisNo+"&color="+color+"&chassisType="+chassis+"&repair="+repair+"&paint="+paint+"&repairDescription="+repairDescription);
}

function jobDone(id,job) {
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response == "Successful") {

                location.reload();
                setLocalStorage("Successful",id + " - " + job + " " + " Job is Completed");
                

            } else {

                location.reload();
                setLocalStorage("Error","Error Completing Job");

            }

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Managers/jobDone", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id="+id+"&job="+job);

}

function saveChanges(id) {
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
        url: 'http://localhost/MicroCAPS/Managers/settings',
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
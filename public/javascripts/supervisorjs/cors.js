
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

    let Chassis01 = document.getElementById("Chassis01").value;
    let chasis02 = document.getElementById("chasis02").value;

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
    xhttp.send("suvQty="+Chassis01+"&normalQty="+chasis02);
}

function addShell() {

    let chassisNo = document.getElementById("chassisNo").value;
    let color = document.getElementById("color").value;
    let chassis = document.getElementById("chassis").value;
    let repair = document.getElementById("repair").checked;
    let paint = document.getElementById("paint").checked;
    let repairDescription = document.getElementById("repairDescription").value


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
                // setLocalStorage("Error","Failed");

            }

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Managers/jobDone", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id="+id+"&job="+job);

}

// function saveChanges(id) {

//     let image = document.getElementById("image").files[0];
    
//     var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             var response = this.responseText;

//             if (response == "Successful") {

//                 location.reload();
//                 setLocalStorage("Successful","Saved Changes");

//             } else {

//                 // console.log(image);
//                 console.log(response);
//                 // location.reload();
//                 setLocalStorage("Error","Error Saving Changes");

//             }

//         }
//     };
//     xhttp.open("POST", "http://localhost/MicroCAPS/Managers/settings", true);
//     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     xhttp.send("id="+id+"&image="+image);
//     // if (image) {
//     //     console.log("Methanin");
       
//     // } else {
//     //     xhttp.send("id"+id); //,"firstname="+firstname+"&lastname="+lastname+"email="+email+"&mobile="+mobile+"&nic="+nic);
//     // }

// }

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
                location.reload();
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
    let alert = document.getElementById("alert-success");
    alert.classList.add("display-block");
    alert.classList.add("show");
    alert.innerHTML = "<i class='icon fa-check-circle margin-right-3'></i>"+message;

    setTimeout(() => {
        alert.classList.remove("display-block");
        alert.classList.remove("show");
    }, 5000);
}

//Alert Faliure
function alertFaliure(message) {
    let alert = document.getElementById("alert-faliure");
    alert.classList.add("display-block");
    alert.classList.add("show");
    alert.innerHTML = "<i class='icon fa-times-circle margin-right-3'></i>"+message;

    setTimeout(() => {
        alert.classList.remove("display-block");
        alert.classList.remove("show");
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
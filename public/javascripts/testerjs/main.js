const drop = document.getElementById("drop");
const logout = document.getElementById("logout");

drop.addEventListener("click", () => {
    console.log("clicked");
    logout.classList.toggle("show");
});

function addPDI(id,job) {
    
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
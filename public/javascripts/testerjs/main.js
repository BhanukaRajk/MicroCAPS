const drop = document.getElementById("drop");
const logout = document.getElementById("logout");

drop.addEventListener("click", () => {
    console.log("clicked");
    logout.classList.toggle("show");
});

function addPDI(c_no,chk_id, status, emp_id) {
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            if (response == "Successful") {

                location.reload();
                setLocalStorage("Successful",c_no + " - " + chk_id + " " +status + " - " + emp_id + " " + "  Completed");
                

            } else {

                location.reload();
                setLocalStorage("Error","Error Completing Job");

            }

        }
    };
    xhttp.open("POST", "http://localhost/MicroCAPS/Testers/addPDI", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("c_no="+c_no+"&chk_id="+chk_id+"status="+status+"&emp_id="+emp_id);
}
// Get the filter checkboxes and radio buttons
const checkboxes = document.querySelectorAll('input[type=checkbox][name=car-model]');
const radioButtons = document.querySelectorAll('input[type=radio][name=completeness], input[type=radio][name=acceptance]');

console.log("\nRestarted\n");


// Add event listener to the checkboxes and radio buttons
checkboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', filterVehicles);
});
radioButtons.forEach((radioButton) => {
    radioButton.addEventListener('change', filterVehicles);
});

// AJAX function to filter vehicles
function filterVehicles() {
    // Get the selected filter values
    const vehicleTypes = Array.from(document.querySelectorAll("input[type=checkbox][name=car-model]:checked")).map((checkbox) => checkbox.value);
    const completeness = document.querySelector("input[type=radio][name=completeness]:checked").value;
    const acceptance = document.querySelector("input[type=radio][name=acceptance]:checked").value;

    // console.log("\nI'm working\n");
    console.log(vehicleTypes);
    console.log(completeness);
    console.log(acceptance);

    // Send AJAX request to filter vehicles
    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "http://localhost/MicroCAPS/Supervisors/findCars", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onload = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Update the vehicle list with the filtered data
            const vehicleList = document.querySelector('#carList');
            vehicleList.innerHTML = this.responseText;
            console.log(this.responseText);
            console.log("this.responseText");
        }
    }
    // xhttp.send();
    // xhttp.send(`vehicleTypes=${vehicleTypes}&completeness=${completeness}&acceptance=${acceptance}`);
    // xhttp.send("vehicleTypes="+vehicleTypes+"&completeness="+completeness+"&acceptance="+acceptance);
    const vehicleTypesStr = vehicleTypes.join(',');
    xhttp.send(`vehicleTypes=${vehicleTypesStr}&completeness=${completeness}&acceptance=${acceptance}`);

}
import select from './select.js';

// /* Common */
// // Logout Dropdown

const drop = document.getElementById("drop");
const logout = document.getElementById("logout");

drop?.addEventListener("click", () => {
    logout.classList.toggle("display-block");
});

// Select
let dashboard = new select(document.querySelectorAll('.custom-select'));
dashboard.create();

let color = new select(document.querySelectorAll('.custom-select-color'));
color.create("color");

let model = new select(document.querySelectorAll('.custom-select-model'));
model.create("chassis");

let selectArray = [];
function addSelect(type,name) {
    selectArray[type] = new select(document.querySelectorAll(name));
    selectArray[type].create();
}

// Next Button
function next(id) {
    location.replace(id);
}

// Redirect
let assemblyVehicles = document.getElementById("assemblyVehicles");

assemblyVehicles?.addEventListener("change", () => {
    let selectedValue = assemblyVehicles.value;
    if (selectedValue) {
        window.location.href = selectedValue;
    }
});
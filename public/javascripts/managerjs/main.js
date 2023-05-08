import select from './select.js';

/* Common */
// Logout Dropdown
const drop = document.getElementById("drop");
const logout = document.getElementById("logout");

drop?.addEventListener("click", () => {
    logout.classList.toggle("display-block");
});

// Select
let selectArray = [];
function addSelect(type,name,label=false,add=false) {
    selectArray[type] = new select(document.querySelectorAll(name));
    if (label) {
        if (add) {
            selectArray[type].create(type,true);
        } else {
            selectArray[type].create(type);
        }
    } else {
        selectArray[type].create();
    }
}

addSelect("normal",'.custom-select')
addSelect("type1",'.custom-select-type1',true,true)
addSelect("color1",'.custom-select-color1',true,true)
addSelect("color",'.custom-select-color',true)
addSelect("chassis",'.custom-select-model',true)
addSelect("chassisNo",'.custom-select-chassis',true,true)
addSelect("showroom",'.custom-select-showroom',true,true)

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

// Toggle Search
const searchBar = document.querySelector('#search-bar');
const searchButton = document.querySelector('#search-button');

searchButton?.addEventListener('click', () => {
    searchBar.classList.toggle('show-search')
})
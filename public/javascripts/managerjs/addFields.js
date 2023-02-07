import select from './select.js';

// Add Field
const fields = document.getElementById("fields");
let addBtn = document.getElementById("addBtn");
let addBtnContainer = document.getElementById("addBtnContainer");
let type = 1;

$("#fields").on("click", (event) => {

    if (event.target.id === "addBtn") {
        let newtype = type + 1;
        addBtn.parentNode.removeChild(addBtn);
        addBtnContainer.parentNode.removeChild(addBtnContainer);
        const field = document.createElement("div");
        field.className = "display-flex-row align-items-start gap-1";
        field.innerHTML = `
        <div>
            <div class="custom-select custom-select`+newtype+`">
                <select name="type`+newtype+`" class="form-control form-control-blue text-blue" id="type`+newtype+`">
                    <option value="">Select Chassis Type</option>
                    <option value="Micro Panda">Micro Panda</option>
                    <option value="Micro Panda Cross">Micro Panda Cross</option>
                    <option value="MG ZS SUV">MG ZS SUV</option>
                </select>
            </div>
        </div>
        <div>
            <input type="number"
                id="qty`+newtype+`"
                name="qty`+newtype+`"
                onChange=""
                value="0"
                class="form-control"
                placeholder="Username"
                autocomplete="off"
                required />
            <label class="form-label">Quantity</label>
        </div>
        <div class="addBtn font-size-24 font-weight border-blue background-blue text-white padding-2 border-radius-11" id="addBtnContainer">
            <i class="fas fa-plus" id="addBtn"></i>
        </div>
        `;
        fields.appendChild(field);
        addBtn = document.getElementById("addBtn");
        addBtnContainer = document.getElementById("addBtnContainer");
        type = newtype; 
        addSelect(newtype, '.custom-select'+newtype);
    }

});

// select

let selectArray = [];
function addSelect(type, name) {
    selectArray[type] = new select(document.querySelectorAll(name));
    selectArray[type].create();
}
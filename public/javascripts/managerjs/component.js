import select from './select.js';

// Add Field
const fields = document.getElementById("fields");
let addBtn = document.getElementById("addBtn");
let addBtnContainer = document.getElementById("addBtnContainer");
let minusBtn = document.getElementById("minusBtn");
let minusBtnContainer = document.getElementById("minusBtnContainer");
let type = 1;

$("#fields").on("click", (event) => {

    if (event.target.id === "addBtn") {
        type = type + 1;
        addBtn.parentNode.removeChild(addBtn);
        addBtnContainer.parentNode.removeChild(addBtnContainer);

        let btn = "";

        if (type === 5) {
            btn = ``;
        } else {
            btn = `
            <div class="addBtn text-hover-blue font-size-24 font-weight border-blue background-blue text-white padding-2 border-radius-11" id="addBtnContainer">
                <i class="fas fa-plus" id="addBtn"></i>
            </div>
            `;
        }

        const field = document.createElement("div");
        field.className = "display-flex-row align-items-start gap-1";
        field.id = "field"+type;
        field.innerHTML = `
        <div>
            <div class="custom-select-type`+type+`">
                <select name="type`+type+`" class="form-control form-control-blue text-blue" id="type`+type+`">
                    <option value="">Select Chassis Type</option>
                    <option value="M0001">Micro Panda</option>
                    <option value="M0002">Micro Panda Cross</option>
                    <option value="M0003">MG ZS SUV</option>
                </select>
                <label class="type`+type+`-label text-blue display-none" id="type`+type+`-label">Chassis Type</label>
            </div>
        </div>
        <div>
            <div class="custom-select-color`+type+`">
                <select name="color`+type+`" class="form-control form-control-blue text-blue chassisColor" id="color`+type+`">
                    <option value="">Select Color</option>
                </select>
                <label class="color`+type+`-label text-blue display-none" id="color`+type+`-label">Color</label>
            </div>
        </div>
        <div>
            <input type="number"
                id="qty`+type+`"
                name="qty`+type+`"
                onChange=""
                value="0"
                class="form-control"
                placeholder="Username"
                autocomplete="off"
                required />
            <label class="form-label">Quantity</label>
        </div>
        <div class="addBtn text-hover-red font-size-24 font-weight border-red background-red text-white padding-2 border-radius-11" id="minusBtnContainer">
            <i class="fas fa-minus" id="minusBtn"></i>
        </div>
        ${btn}
        `;
        fields.appendChild(field);
        addBtn = document.getElementById("addBtn");
        addBtnContainer = document.getElementById("addBtnContainer");
        addSelect('type'+type, '.custom-select-type'+type);
        addSelect('color'+type, '.custom-select-color'+type);
        addStyles(type);
        //add element to type array
        typeArray.push('type'+type);
        colorArray.push('color'+type);
        updateColorOptions();
    }
    else if (event.target.id === "minusBtn") {

        let minusBtnParent = event.target.parentNode.parentNode;
        minusBtnParent.parentNode.removeChild(minusBtnParent);

        
        type = type - 1;

        let lastChild = document.getElementById("fields").lastElementChild;

        const addfield = document.createElement("div");
        addfield.className = "addBtn text-hover-blue font-size-24 font-weight border-blue background-blue text-white padding-2 border-radius-11";
        addfield.id = "addBtnContainer";
        addfield.innerHTML = `
        <i class="fas fa-plus" id="addBtn"></i>
        `;
        lastChild.appendChild(addfield);
        addBtn = document.getElementById("addBtn");
        addBtnContainer = document.getElementById("addBtnContainer");
        //remove element from type array
        typeArray.pop();
        colorArray.pop();
        updateColorOptions();
    }

});

// select

let selectArray = [];
function addSelect(type,name) {
    selectArray[type] = new select(document.querySelectorAll(name));
    selectArray[type].create(type,true);
}

function addStyles(type) {
    const link = document.querySelector('link[href="http://localhost/MicroCAPS/public/stylesheets/manager/javascript.css"]');
    const styleSheet = link.sheet;
    styleSheet.insertRule(".custom-select-type"+type+", .custom-select-color"+type+" { position: relative; display: inline-block; font-size: 14px; }", styleSheet.cssRules.length);
    styleSheet.insertRule(".custom-select-type"+type+ " .selector-options, .custom-select-color"+type+ " .selector-options { list-style: none; color: #017EFA; border: 1px solid; height: auto; width: 100%; position: absolute; z-index: 1; background-color: #fff; }", styleSheet.cssRules.length);
    styleSheet.insertRule(".custom-select-type"+type+ " .selector-options li, .custom-select-color"+type+ " .selector-options li { padding: 0.5rem; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 0.3s ease; }", styleSheet.cssRules.length);
    styleSheet.insertRule(".custom-select-type"+type+ " .selector-options li:hover, .custom-select-color"+type+ " .selector-options li:hover { background: #017EFA; color: white; }", styleSheet.cssRules.length); 
    styleSheet.insertRule(".type"+type+"-label, .color"+type+"-label {  position: relative; bottom: 3.9em; left: 1.5em; background-color: white; padding: 0 0.5em; opacity: 1; color: var(--gray); }", styleSheet.cssRules.length);        
}

let typeArray = ["type1"];
let colorArray = ["color1"];

function updateColorOptions() {  
    typeArray.forEach((type) => {
  
      const chassis = document.getElementById(type);
      const color = document.getElementById(colorArray[typeArray.indexOf(type)]);
  
      chassis?.addEventListener("change", () => {
        chassis.classList.remove("form-control-red");
  
        let Colors = []
  
        if (chassis.value === "M0001") {
          Colors = ["White", "Black", "Red", "Green", "Blue", "Yellow"];
        } else if (chassis.value === "M0002" || chassis.value === "M0003") {
          Colors = ["Black", "Red", "Green", "Blue"];
        } 
  
        color.innerHTML = '<option value="">Select Color</option>';
  
        Colors.forEach(element => {
          const option = document.createElement("option");
          option.value = element;
          option.innerHTML = element;
          color.appendChild(option);
        });
  
      });
  
      color?.addEventListener("change", () => {
        color.classList.remove("form-control-red");
      });
    });
  }

  updateColorOptions();
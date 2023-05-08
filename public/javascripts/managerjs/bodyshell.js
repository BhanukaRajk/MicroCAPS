/* Body Shell */
// Body Shell Functions
function rounds(evt, option) {
    var i = 0, shellOption;

    content = document.getElementsByClassName("shell-forms");
    for (i = 0; i < content.length; i++) {
        content[i].classList.remove("display-block");
    }

    shellOption = document.getElementsByClassName("shell-btn");
    for (i = 0; i < shellOption.length; i++) {
        shellOption[i].classList.remove("active");
    }

    document.getElementById(option).classList.add("display-block");
    evt.currentTarget.classList.add("active");
}

// Body Shell - Add Shell
const chassisNo = document.getElementById("chassisNo");
const chassisNoLabel = document.getElementById("chassisNo-label");

chassisNo?.addEventListener("input", () => {
    chassisNo.classList.remove("form-control-red");
    chassisNoLabel.classList.remove("red");
    chassisNoLabel.innerHTML = "Chassis Number";
});

const chassis = document.getElementById("chassis");
const color = document.getElementById("color");

chassis?.addEventListener("change", () => {
    chassis.classList.remove("form-control-red");
    chassis.classList.remove("text-red");
    chassis.classList.add("text-gray");

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
    color.classList.remove("text-red");
    color.classList.add("text-gray");
});

// Body Shell - Re Request Repair - Paint
function reRequest(id, job, chassis) {

    const parentNode = document.getElementById("four");

    const overlay = parentNode.querySelector("#overlay");
    const popcon = parentNode.querySelector("#pop-con");
    const poptitle = parentNode.querySelector("#pop-title");

    const chassisNo = document.getElementById("jobchassis");
    const jobFields = document.getElementById("job-fields");
    const jobCheckbox = document.getElementById("job-checkbox");

    overlay.classList.add('visible');
    popcon.classList.add('pop');
    poptitle.innerHTML = "Request a Re-"+job;

    chassisNo.value = chassis;
    jobCheckbox.innerHTML =
        `Complete Previous Job : ${id}
        <input type="checkbox"
                id="previous"
                name="${job}"
                value="Yes"
                checked>
        <div class="checkmark"></div>`
    ;

    if (job === "repair") {
        const field = document.createElement("div");
        field.innerHTML =`                            
                            <input type="text"
                                id="re-repairDescription"
                                name="re-repairDescription"
                                onChange=""
                                value=""
                                class="form-control"
                                placeholder="Repair Description"
                                autocomplete="off"
                                required />
                            <label class="form-label" id="re-repairDescription-label">Repair Description</label>`;
        jobFields.appendChild(field);
    }

    if (job === "paint") {
        const reButtons = document.getElementById("re-buttons");
        reButtons.classList.add("display-flex-column", "align-items-center", "gap-0p5");
    }

    const requestbtn = parentNode.querySelector("#requestbtn");
    requestbtn.onclick = () => {
        sendRequest(id, job);
    };
       
    const cancelbtn = parentNode.querySelector("#cancel");
    cancelbtn.onclick = () => {
        location.reload();
        setLocalStorageOption("option-four");
    };

}

// Body Shell Details
function show(evt, option, set) {
    var i = 0, shellOption;

    content = document.getElementsByClassName(set);
    for (i = 0; i < content.length; i++) {
        content[i].classList.add("display-none");
    }

    shellOption = document.getElementsByClassName(set+"numbers");
    for (i = 0; i < shellOption.length; i++) {
        shellOption[i].classList.remove("active");
    }

    document.getElementById(option).classList.remove("display-none");
    evt.currentTarget.classList.add("active");
}

// Repir - Paint Checkbox
const repair = document.getElementById("repair");
const paint = document.getElementById("paint");
const repairD = document.getElementById("repairD");
const repairDescription = document.getElementById("repairDescription");
const repairDescriptionLabel = document.getElementById("repairDescription-label");

repair?.addEventListener("change", () => {
    if (repair.checked) {
        paint.checked = true;
        repairD.classList.toggle("display-none");
        repairDescription.required = true;
    } else {
        paint.checked = false;
        repairD.classList.toggle("display-none");
        repairDescription.required = false;
    }
});

repairDescription?.addEventListener("input", () => {
    repairDescription.classList.remove("form-control-red");
    repairDescriptionLabel.classList.remove("red");
});

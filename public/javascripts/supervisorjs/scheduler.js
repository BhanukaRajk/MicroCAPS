function enableTaskFind() {
    let input = document.getElementById("TaskName");
    let vehicle = document.getElementById("vehicles").value;

    if(vehicle == "") {
        input.disabled = true;
        input.focus(false);
    } else {
        input.disabled = false;
        input.focus();
    }

}

function pickId(ProcessId, ProcessName) {
    let name = document.getElementById("TaskName");
    let id = document.getElementById("TaskId");
    let menu = document.getElementById("taskMenu");

    menu.classList.add("display-none");

    name.value = "";
    name.value = ProcessName;
    id.value = "";
    id.value = ProcessId;
}


function findCarProcesses() {

    let searchInput = document.getElementById("TaskName").value.toUpperCase();
    let vehicle = document.getElementById("vehicles").value;

    const formData = new FormData();
    formData.append("searchingTask", searchInput);
    formData.append("selectedCar", vehicle);

    if (!formData) {
        console.error("FormData not supported");
        return;
    }

    fetch(BASE_URL + "Supervisors/searchProcesses", {
        method: "POST",
// headers: {
//     'Content-type': 'multipart/form-data'
//     'Content-type': 'application/json'
// },
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {

            const process_list = document.querySelector('#taskMenu');

            if(data) {
                let processSet = '';
                data.forEach((process) => {
                    processSet += `<li onclick="pickId('${process.ProcessId}','${process.ProcessName}')">${process.ProcessName}</li>`;
                });
                processSet += '';

                process_list.innerHTML = processSet;

                process_list.classList.remove("display-none");

            }
        })
        .catch((error) => console.error(error));
}

let addBtn = document.getElementById("add-task-btn");

addBtn?.addEventListener("click", function () {

    let vehicle = document.getElementById("vehicles").value;
    let task = document.getElementById("TaskId").value;

    const formData = new FormData();
    formData.append("task", task);
    formData.append("selectedCar", vehicle);

    if (!formData) {
        console.error("FormData not supported");
        return;
    }

    fetch(BASE_URL + "Supervisors/searchAssembler", {
        method: "POST",
// headers: {
//     'Content-type': 'multipart/form-data'
//     'Content-type': 'application/json'
// },
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {

            const assemblerSelect = document.getElementById("assembler");

            if(data) {
                let assemblerSet = '<option value="">Select Assembler</option>';
                data.forEach((assembler) => {
                    assemblerSet += `<option value="${assembler.EmployeeId}">${assembler.Name}</option>`;
                });
                assemblerSet += '';

                assemblerSelect.innerHTML = assemblerSet;

            }
        })
        .catch((error) => console.error(error));

});

function addTask() {

    let vehicle = document.getElementById("vehicles").value;
    let task = document.getElementById("TaskId").value;
    let assembler = document.getElementById("assembler").value;

    const formData = new FormData();
    formData.append("task", task);
    formData.append("selectedCar", vehicle);
    formData.append("assembler", assembler);

    if (!formData) {
        console.error("FormData not supported");
        return;
    }

    fetch(BASE_URL + "Supervisors/addTask", {
        method: "POST",
// headers: {
//     'Content-type': 'multipart/form-data'
//     'Content-type': 'application/json'
// },
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            location.reload();
        })
        .catch((error) => console.error(error));


}


// UPDATING THE TASKS
function taskUpdateOpen($ChassisNo, $ProcessId, $Assembler) {


    const toolDataBoard = document.querySelector('#asm-add-2');
    document.getElementById("asm-add-2").classList.remove("display-none");

}
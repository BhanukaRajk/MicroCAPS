const BASE_URL = "http://localhost:8080/MicroCAPS/";


function findCarProcesses() {

    let searchInput = document.getElementById("TaskName").value.toUpperCase();
    let vehicle = document.getElementById("vehicles").value;


    console.log(searchInput);
    console.log(vehicle);

    // let input = document.getElementById("TaskName");
    // if(input.value == "") {
    //     document.getElementById("taskMenu").classList.toggle("display-none");
    // } else {
    //     document.getElementById("taskMenu").classList.remove("display-none");
    // }



    
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

            console.log("Data = "+data);
            const process_list = document.querySelector('#taskMenu');

            if(data) {
                let processSet = '';
                data.forEach((process) => {
                    processSet += `<li value="${process.ProcessId}">${process.ProcessName}</li>`;
                });
                processSet += '';

                process_list.innerHTML = processSet;

            }
        })
        .catch((error) => console.error(error));
}










// THE WAY TO INSERT, SELECTED DATA TO THE INPUT BOX
const input = document.querySelector('#TaskName');
const listItems = document.querySelectorAll('#taskMenu');

listItems.forEach(item => {
    item.addEventListener('click', () => {
        input.value = item.textContent;
    });
});




// UPDATING THE TASKS
function taskUpdateOpen($ChassisNo, $ProcessId, $Assembler) {


    const toolDataBoard = document.querySelector('#asm-add-2');
    document.getElementById("asm-add-2").classList.remove("display-none");

}
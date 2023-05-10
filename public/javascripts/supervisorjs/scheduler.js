// GET ALL FILTER CHECKBOXES AND RADIO BUTTONS
// let task_search = document.querySelectorAll("input[type=text][name=TaskName]");
// let select_car = document.querySelectorAll("select[name=vehicles]");
//// const acceptanceRadios = document.querySelectorAll("input[type=radio][name=acceptance]");
// let searchInput = document.getElementById("TaskName").value.toUpperCase();


// ATTACH EVENT LISTENERS TO ALL FILTER INPUTS
// for (let checkbox of checkboxes) {
//     checkbox.addEventListener('change', findCarProcesses);
// }



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
    

    fetch("http://localhost:8080/MicroCAPS/Supervisors/searchProcesses", {
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




const input = document.querySelector('#TaskName');
const listItems = document.querySelectorAll('#taskMenu');

listItems.forEach(item => {
  item.addEventListener('click', () => {
    input.value = item.textContent;
  });
});


function taskUpdateOpen($ChassisNo, $ProcessId, $Assembler) {

    document.getElementById("asm-add-2").classList.remove("display-none");

}
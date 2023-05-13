// TASK COMPLETION UPDATING FUNCTION
const BASE_URL = "http://localhost:8080/MicroCAPS/";

const taskStateCheckboxes = document.querySelectorAll("input[type=checkbox][class=P28_taskrecord]");

for (let task of taskStateCheckboxes) {

    task.addEventListener('change', function() {

        const selectedTask = this.id;
        let selectedTaskStatus;

        if(this.checked) {
            selectedTaskStatus = 1;
        } else {
            selectedTaskStatus = 0;
        }

        const TaskData = selectedTask.split("-");
        console.log(TaskData[0]);


        const formData = new FormData();
        formData.append("car_id", TaskData[0]);
        formData.append("process_id", TaskData[1]);
        formData.append("status", selectedTaskStatus);

        if (!formData) {
            console.error("FormData not supported");
            return;
        }
        

        fetch(BASE_URL + "Supervisors/recordScheduleStatus", {
            method: "POST",
            // headers: {
            //     'Content-type': 'multipart/form-data'
            //     // 'Content-type': 'application/json'
            // },
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
            })
            .catch((error) => { 
                const taskRecord = document.querySelector('#'+selectedTask);
                console.log(taskRecord);

                if(taskRecord.checked == true) {
                    taskRecord.checked = false;
                } else {
                    taskRecord.checked = true;
                }

                // notifyMe();

                console.error(error);
            });
    })
};






const processstateboxes = document.querySelectorAll("input[type=checkbox][name=schedule-task-status]");

for (let task of taskstaeboxes) {

    task.addEventListener('change', function() {

        const selectedTask = this.id;
        let selectedTaskStatus;

        if(this.checked) {
            selectedTaskStatus = 1;
        } else {
            selectedTaskStatus = 0;
        }

        const TaskData = selectedTask.split("-");
        console.log(TaskData[0]);


        const formData = new FormData();
        formData.append("car_id", TaskData[0]);
        formData.append("process_id", TaskData[1]);
        formData.append("status", selectedTaskStatus);

        if (!formData) {
            console.error("FormData not supported");
            return;
        }
        

        fetch(BASE_URL + "Supervisors/recordScheduleStatus", {
            method: "POST",
            // headers: {
            //     'Content-type': 'multipart/form-data'
            //     // 'Content-type': 'application/json'
            // },
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
            })
            .catch((error) => { 
                const taskRecord = document.querySelector('#'+selectedTask);
                console.log(taskRecord);

                if(taskRecord.checked == true) {
                    taskRecord.checked = false;
                } else {
                    taskRecord.checked = true;
                }

                // notifyMe();

                console.error(error);
            });
    })
};







function taskDeleteConfirmation(Car, Process) {
    // GET THE VALUES FROM THE LEAVE TABLE

    // FILL THE INPUT FIELDS IN THE FORM
    document.getElementById("del-task-car-id").setAttribute("value", Car);
    document.getElementById("del-task-process-id").setAttribute("value", Process);

    // SHOW THE POPUP FORM
    document.getElementById("P28_taskdelpopupWindow").classList.remove("display-none");
}


function closeleaveDeleteConfirmation() {

    // CLOSE THE POPUP FORM
    document.getElementById("popupWindow").classList.toggle("display-none");
    //// document.getElementById("popupWindow").setAttribute("class", "delete-conf-blur horizontal-centralizer display-none");
    //// document.getElementsByClassName("databoard").classList.remove("noscroll");
}